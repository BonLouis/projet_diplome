@extends('back.master')
@section('content')
{{-- Top buttons --}}
<div class="section center-align">
	<a id="create" class="waves-effect waves-light btn-small modal-trigger my-2" href="#modal"><i class="material-icons left">add_circle</i>Créer</a>
	<a id="trash" href="#modal" class="waves-effect waves-light btn-small modal-trigger{{ $trash->count() ? '' : ' disabled' }}">
		<i class="material-icons left">delete</i>
		Corbeille (<span id="trash-count">{{ $trash->count() }}</span>)
	</a>
</div>
<div class="row">
	<div class="input-field col s12 m4 offset-m4">
		<i class="material-icons prefix">search</i>
		<input id="search" name="search" type="text">
		<label for="search">Votre recherche</label>
	</div>
</div>
{{-- Posts list and pagination --}}
{{--  --}}
<div id="table-target">
	@include('back.table', compact('posts'))
</div>
{{--  --}}
{{-- 
 --}}
<div id="modal" class="modal modal-fixed-footer"></div>
@endsection
{{--
	-  -  -  -  -  -  Javascript part  -  -  -  -  -  -  -  -  -
--}}
@push('backScripts')
<script>
/*
	Will be triggered on html rebuild with ajax content.
 */
const rebuildEvent = new Event('rebuild');
document.addEventListener('rebuild', mainHandler)
document.addEventListener('DOMContentLoaded', ready => {
	$('#modal').modal();
	mainHandler();
	$('#create').click(function() {
		reinitModal();
		axios.get(`/admin/loadBlankForm`)
			.then(({ data }) => {
				$('#modal').html(data);
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
	$('#search').keyup(function(e) { // "on.('enter', ..."
	// if (e.which === 13) {
		axios.get('/search', {
			params: {
				search: $('#search').val(),
				admin: 'true'
			}
		})
		.then(({ data }) => {
			FlashAndReloadContent(data, true);
			handlePagination();
		})
		.catch(a => {
			console.log(a);
		})
	// }
});
});
function mainHandler() {
	$('.post-edit, .post-delete').click(function() {
		const id = $(this).siblings('.post-id').text();
		if ($(this).hasClass('post-edit')) {
			axios.get(`/admin/loadOneAndEdit/${id}`)
			.then(({ data }) => {
				$('#modal').html(data);
				reinitModal();
			});
		}
		else if ($(this).hasClass('post-delete')) {
			axios.get(`/admin/trash/${id}`)
			.then(({ data }) => {
				toggleTrashIcon($(this));
				togglePostStatus($(this), data.newStatus);
				updateTrashCount(data.newCount);
				flash(data.msg.level, data.msg.html);
			});
		}
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
function FlashAndReloadContent(data, searchMode = false) {
	// Update html content
	$('#table-target').html(data.viewTable);
	if (searchMode) {
		document.dispatchEvent(rebuildEvent);
		return 0;
	}
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
	$('.timepicker').timepicker({container: 'body', twelveHour: false});
	M.updateTextFields();
	M.textareaAutoResize($('textarea'));
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
			console.log(data);
			FlashAndReloadContent(data);
			$('#modal').modal('close');
		})
		.catch(({ response }) => {
			flash('errorMsg', 'Votre formulaire contient des erreurs');
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
	$('#picture_url').change(function() {
		$('#img_preview').attr('src', $(this).val() || 'https://dummyimage.com/600x400/ccc/000&text=Votre future image');
	});
}


function handlePagination() {
	$('.pagination a').click(function(e) {
		e.preventDefault();
		axios.get($(this).attr('href'), {
			params: {
				search: $('#search').val(),
				admin: 'true',

			}
		})
		.then(({ data }) => {
			FlashAndReloadContent(data, true);
			handlePagination();
		})
		.catch(a => {
			console.log(a);
		})
	})
}
</script>
@endpush
