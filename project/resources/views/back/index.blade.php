@extends('back.master')
@section('content')
<div></div>
{{-- Top buttons --}}
<div class="section center-align">
	<a id="create" class="waves-effect waves-light btn-small modal-trigger" href="#modal"><i class="material-icons left">add_circle</i>Créer</a>
	{{-- <a class="waves-effect waves-light btn-small"><i class="material-icons left">mode_edit</i>Édition rapide</a> --}}
	<a id="trash" href="#modal" class="waves-effect waves-light btn-small modal-trigger{{ $trash->count() ? '' : ' disabled' }}">
		<i class="material-icons left">delete</i>
		Corbeille (<span id="trash-count">{{ $trash->count() }}</span>)
	</a>
</div>

{{-- Posts list --}}
<div id="table-target">
	@include('back.table', compact('posts'))
</div>
<div id="modal" class="modal modal-fixed-footer">
</div>
@endsection
@push('backScripts')
<script>
// Will be triggered on html rebuild with ajax content.
const rebuildEvent = new Event('rebuild');
document.addEventListener('rebuild', mainHandler)

document.addEventListener('DOMContentLoaded', ready => {
	$('#modal').modal();
	mainHandler();
	$('#create').click(function() {
		axios.get(`/admin/loadBlankForm`)
			.then(({ data }) => {
				$('.modal-content').html(data);
				reinitModal();
			});
	});
	$('#trash').click(function() {
		axios.get(`/admin/loadTrashes`)
			.then(({ data }) => {
				$('#modal').html(data);
				initForTrash();
			});
	});
});
function mainHandler() {
	console.log('main');
	$('.post-edit, .post-delete').click(function() {
			const id = $(this).siblings('.post-id').text();
			if ($(this).hasClass('post-edit')) {
				axios.get(`/admin/loadOneAndEdit/${id}`)
				.then(({ data }) => {
					$('#modal').html(data);
					reinitModal();
					// $('#modal').showModal();
				});
			}
			if ($(this).hasClass('post-delete')) {
				axios.get(`/admin/trash/${id}`)
				.then(({ data }) => {
					toggleTrashIcon($(this));
					togglePostStatus($(this), data.newStatus);
					updateTrashCount(data.newCount);
					flash(data.msg.level, data.msg.html);
				});
			}
		});
		$('#modal button[type="submit"]').click(function() {
			const form = $('#form-to-send');
			const id = form.data('post-id');
			const begin_at = form.find('#_begin_at_date').val() + ' ' + form.find('#_begin_at_hour').val();
			const end_at = form.find('#_end_at_date').val() + ' ' + form.find('#_end_at_hour').val();
			form.find('[name="begin_at"]').val(begin_at);
			form.find('[name="end_at"]').val(end_at);
			axios(`/admin/post/${id}`, {
				method: $('[name="_method"]').attr('value'),
				data: form.serialize()
			})
			.then(({data}) => {
				M.toast({
					html: `Post n°${data} créé avec succès`,
						classes	: 'green'
				});
			})
			.catch(({ response }) => {
				$('#form-to-edit input[name]').removeClass('invalid');
				const form = $('#form-to-send');
				for (const name in response.data.errors) {
					for (const error of response.data.errors[name]) {
						// We just check that because of the hidden input dynamically charged
						if (name === 'end_at') {
							form.find('#_end_at_date').addClass('invalid');
							form.find('#_end_at_date ~ .helper-text').attr('data-error', error)
						} else {
							form.find(`[name="${name}"]`).addClass('invalid');
							form.find(`[name="${name}"] ~ .helper-text`).attr('data-error', error)
						}
					}
				}
			})
		});
}
function initForTrash () {
	// Thanks Materialize...
	$('[id*="untrash"]').click(function() {
		if ($(this).attr('checked'))
			$(this).removeAttr('checked');
		else
			$(this).attr('checked', '');
	});
	$('#trash_cancel').click(function() { $('#modal').modal('close'); });
	$('#trash_untrash_all').click(yo => {TrashModalAjaxHandler_withoutParameter('/admin/untrash')});
	$('#trash_confirm_all').click(yo => {TrashModalAjaxHandler_withoutParameter('/admin/destroyTrash')});
	$('#trash_untrash_some').click(yo => {TrashModalAjaxHandler_withParameters('/admin/untrash')});
	$('#trash_confirm_some').click(yo => {TrashModalAjaxHandler_withParameters('/admin/destroyTrash')});
}
function FlashAndReloadContent(data) {
	// Update html content
	$('#table-target').html(data.viewTable);
	$('#modal').html(data.viewModal);
	updateTrashCount(data.newCount);
	// Emit an event to trigger the function
	// which is responsible of attach event.
	// Necessary because of the html update
	// detach them.
	document.dispatchEvent(rebuildEvent);
	initForTrash();
	// Emit a message. See resources/view/partials/messager
	flash(data.msg.level, data.msg.html);
}
function TrashModalAjaxHandler_withoutParameter(url) {
	axios.post(url).then(({data}) => {
		FlashAndReloadContent(data)
	});
}
function TrashModalAjaxHandler_withParameters(url) {
	const ids = [];
	$('input[id*="untrash"][checked]').each(function(i,e) {
		ids.push($(e).attr('id').replace('untrash-', ''))
	});
	axios.post(url, {
		ids,
		some: true
	}).then(({data}) => {
		FlashAndReloadContent(data)
	});
}
function toggleTrashIcon (tdTarget) {
	const i = tdTarget.find('i');
	const newIcon = i.text() === 'delete' ? 'undo' : 'delete';
	i.text(newIcon);
}
function togglePostStatus (tdTarget, status) {
	tdTarget.siblings('.status').text(status);
}
function updateTrashCount (value) {
	$('#trash-count').text(value);
	if (value) {
		$('#trash').removeClass('disabled');
	} else {
		$('#trash').addClass('disabled');
	}
}
function toaster (id, status) {
	let html = '';
	if (status === 'trash')
		html = `Post n°${id} ajouté à la corbeille.`;
	else
		html = `Post n°${id} retiré de la corbeille avec le status '${status}'.`;
	M.toast({
		html,
			classes	: 'green'
	});
}
function reinitModal () {
	$('select').formSelect();
	$('.datepicker').datepicker({container: 'body', format: 'yyyy-mm-dd'});
	$('.timepicker').timepicker({container: 'body'});
	M.updateTextFields();
	M.textareaAutoResize($('textarea'));
}
</script>
@endpush
