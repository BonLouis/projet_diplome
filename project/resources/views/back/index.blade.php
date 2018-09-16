@extends('back.master')

@section('content')
<div></div>
{{-- Top buttons --}}
<div class="section center-align">
		<a class="waves-effect waves-light btn-small"><i class="material-icons left">add_circle</i>Créer</a>
		<a class="waves-effect waves-light btn-small"><i class="material-icons left">mode_edit</i>Édition rapide</a>
		<a id="trash" class="waves-effect waves-light btn-small{{ $trash->count() ? '' : ' disabled' }}">
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
			{{-- <td>{{ $post->price }}</td> --}}
			{{-- <td>{{ $post->max_seats }}</td> --}}
			{{-- <td>{{ $post->begin_at }}</td> --}}
			<td>{{ $post->end_at }}</td>
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
			$('.datepicker').datepicker({container: 'body'});
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
			axios(`/admin/post/${id}`, {
				method: $('[name="_method"]').attr('value')
			})
			.then(d => {

			})
			.catch(err => {
				console.log(err);
			})
		});

		// $('#trash').click('')
	});
</script>
@endpush
