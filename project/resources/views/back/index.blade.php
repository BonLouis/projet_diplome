@extends('back.master')

@section('content')
<div></div>
{{-- Top buttons --}}
<div class="section center-align">
		<a id="create" class="waves-effect waves-light btn-small modal-trigger" href="#edit-modal"><i class="material-icons left">add_circle</i>Créer</a>
		{{-- <a class="waves-effect waves-light btn-small"><i class="material-icons left">mode_edit</i>Édition rapide</a> --}}
		<a id="trash" href="#edit-modal" class="waves-effect waves-light btn-small modal-trigger{{ $trash->count() ? '' : ' disabled' }}">
			<i class="material-icons left">delete</i>
			Corbeille (<span>{{ $trash->count() }}</span>)
		</a>
</div>
{{-- Trash button --}}
<div class="fixed-action-btn top-right">
	{{-- @if($trash->count())
	<span class="badge new" data-badge-caption="">{{ $trash->count() }}</span>
	@endif --}}
	<a class="btn-floating btn-large waves-effect waves-light red right">
		<i class="material-icons">delete</i>
	</a>
</div>
{{-- Posts list --}}
<table class="responsive-table highlight">
	<thead>
		<tr>
			<th>#</th>
			<th></th>
			<th>Titre</th>
			<th>Type</th>
			<th>Prix</th>
			{{-- <th>Places</th> --}}
			{{-- <th>Début</th> --}}
			{{-- <th>Fin</th> --}}
			<th>Status</th>
			<th>Ouvert</th>
		</tr>
	</thead>
	<tbody>
	@foreach($posts as $post)
		<tr>
			<th class="post-id">{{ $post->id }}</th>
			<td class="post-edit">
				<a class="edit btn-floating btn-small modal-trigger" href="#edit-modal">
					<i class="material-icons">mode_edit</i>
				</a>
			</td>
			<td>{{ $post->title }}</td>
			<td>{{ $post->type }}</td>
			<td>{{ $post->price }}</td>
			{{-- <td>{{ $post->max_seats }}</td> --}}
			{{-- <td>{{ $post->begin_at }}</td> --}}
			{{-- <td>{{ $post->end_at }}</td> --}}
			<td class="status">{{ $post->status }}</td>
			<td>{{ $post->open }}</td>
			<td class="post-delete">
				<a class="btn-floating btn-small red">
					<i class="material-icons">{{ $post->status === 'trash' ? 'undo' : 'delete'}}</i>
				</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<div id="edit-modal" class="modal modal-fixed-footer">
	<div class="modal-content">
	</div>
	<div class="modal-footer center-align">
		<button type="submit" class="btn btn-primary">Envoyer</button>
	</div>
</div>
@endsection

@push('backScripts')
<script>
	document.addEventListener('DOMContentLoaded', ready => {
		const toggleTrashIcon = tdTarget => {
			const i = tdTarget.find('i');
			const newIcon = i.text() === 'delete' ? 'undo' : 'delete';
			i.text(newIcon);
		};
		const togglePostStatus = (tdTarget, status) => {
			tdTarget.siblings('.status').text(status);
		};
		const updateTrashCount = value => {
			$('#trash span, .badge').text(value);
			if (value) {
				$('#trash').removeClass('disabled');
			} else {
				$('#trash').addClass('disabled');
			}
		};
		const toaster = (id, status) => {
			let html = '';
			if (status === 'trash')
				html = `Post n°${id} ajouté à la corbeille.`;
			else
				html = `Post n°${id} retiré de la corbeille avec le status '${status}'.`;
			M.toast({
				html,
				classes	: 'green'
			});
		};
		const reinitModal = yo => {
			$('select').formSelect();
			$('.datepicker').datepicker({container: 'body', format: 'yyyy-mm-dd'});
			$('.timepicker').timepicker({container: 'body'});
			M.updateTextFields();
			M.textareaAutoResize($('textarea'));
		}
		$('#edit-modal').modal();
		$('.post-edit, .post-delete').click(function() {
			const id = $(this).siblings('.post-id').text();
			if ($(this).hasClass('post-edit')) {
				axios.get(`/admin/loadOneAndEdit/${id}`)
				.then(({ data }) => {
					$('.modal-content').html(data);
					reinitModal();
					// $('#edit-modal').showModal();
				})
				.catch(err => {
					M.toast({
						html: err.message,
						classes	: 'red'
					});
				});
			}
			if ($(this).hasClass('post-delete')) {
				axios.get(`/admin/trash/${id}`)
				.then(({ data }) => {
					toggleTrashIcon($(this));
					togglePostStatus($(this), data.newStatus);
					updateTrashCount(data.newCount);
					toaster(id, data.newStatus);
				})
				.catch(err => {
					M.toast({
						html: err.message,
						classes	: 'red'
					});
				});
			}
		});
		$('#edit-modal button[type="submit"]').click(function() {
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
		$('#create').click(function() {
			axios.get(`/admin/loadBlankForm`)
				.then(({ data }) => {
					$('.modal-content').html(data);
					reinitModal();
				})
				.catch(err => {
					M.toast({
						html: err.message,
						classes	: 'red'
					});
				});
		});
		const initForTrash = holà => {
			// Thanks Materialize...
			$('[id*="untrash"]').click(function() {
				const isChecked = $(this).attr('checked');
				if (isChecked) {
					$(this).removeAttr('checked');
				} else {
					$(this).attr('checked', '');
				}
			});
			$('#trash_cancel').click(function() {
				$('#edit-modal').modal('close');
			});
			$('#trash_untrash_all').click(function() {
				axios.post(`/admin/untrash`)
				.then(aloha => {
					M.toast({
						html: 'Tout les trash sont passés en brouillons.',
						classes	: 'green'
					});
				})
				.catch(err => {
					M.toast({
						html: err.message,
						classes	: 'red'
					});
				});
			});
			$('#trash_untrash_some').click(function() {
				const ids = [];
				$('input[id*="untrash"][checked]').each(function(i,e) {
					ids.push($(e).attr('id').replace('untrash-', ''))
				});
				axios.post(`/admin/untrash`, {
					ids
				})
				.then(aloha => {
					M.toast({
						html: 'Tout les trash sont passés en brouillons.',
						classes	: 'green'
					});
				})
				.catch(err => {
					M.toast({
						html: err.message,
						classes	: 'red'
					});
				});
			});
			$('#trash_confirm_all').click(function() {
				axios.get(`/admin/destroyTrash`)
				.then(aloha => {
					M.toast({
						html: 'Tout les trash sont passés en brouillons.',
						classes	: 'green'
					});
				})
				.catch(err => {
					M.toast({
						html: err.message,
						classes	: 'red'
					});
				});
			});
			$('#trash_confirm_some').click(function() {
				const ids = [];
				$('input[id*="untrash"][checked]').each(function(i,e) {
					ids.push($(e).attr('id').replace('untrash-', ''))
				});
				axios.post(`/admin/untrash`, {
					ids
				})
				.then(aloha => {
					M.toast({
						html: 'Tout les trash sont passés en brouillons.',
						classes	: 'green'
					});
				})
				.catch(err => {
					M.toast({
						html: err.message,
						classes	: 'red'
					});
				});
			});
		}
		$('#trash').click(function() {
			axios.get(`/admin/loadTrashes`)
				.then(({ data }) => {
					$('#edit-modal').html(data);
					initForTrash();
				})
				.catch(err => {
					M.toast({
						html: err.message,
						classes	: 'red'
					});
				});
		});
		
	});
</script>
@endpush
