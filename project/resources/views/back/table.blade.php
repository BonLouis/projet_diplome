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
			<td>{{ ucfirst($post->type) }}</td>
			<td>{{ $post->price }}</td>
			{{-- <td>{{ $post->max_seats }}</td> --}}
			{{-- <td>{{ $post->begin_at }}</td> --}}
			{{-- <td>{{ $post->end_at }}</td> --}}
			<td class="status"><span class="{{ $post->statusClass() }} white-text center-align back-info">{{ $post->status }}</span></td>
			<td class="back-infos"><span class="back-info white-text center-align lighten-2 {{ $post->open ? 'green' : 'red' }}">{{ $post->open ? 'Ouvert' : 'Fermé' }}</span></td>
			<td class="post-delete">
				<a class="btn-floating btn-small red">
					<i class="material-icons">{{ $post->status === 'Corbeille' ? 'undo' : 'delete'}}</i>
				</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@includeWhen(method_exists($posts, 'links'), 'partials.paginate', compact('posts'))
