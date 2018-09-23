@includeWhen(method_exists($posts, 'links'), 'partials.paginate', compact('posts'))
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
				<a class="edit btn-floating btn-small modal-trigger" href="#modal">
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
@includeWhen(method_exists($posts, 'links'), 'partials.paginate', compact('posts'))
