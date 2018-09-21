<div class="modal-content">
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Titre</th>
				<th>Type</th>
				<th>Prix</th>
				<th>Places</th>
				<th>Retirer ?</th>
			</tr>
		</thead>
		<tbody>
			@foreach($posts as $post)
			<tr>
				<th>{{ $post->id }}</th>
				<td>{{ $post->title }}</td>
				<td>{{ $post->type }}</td>
				<td>{{ $post->price }}</td>
				<td>{{ $post->max_seats }}</td>
				<td>
					<label for="untrash-{{ $post->id }}">
						<input type="checkbox" id="untrash-{{ $post->id }}"/>
						<span></span>
					</label>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="modal-footer" style="height: 140px;">
	<div class="center-align">
		<button id="trash_cancel" class="btn btn-small blue">Annuler</button>
	</div>
	<div class="center-align">
		<button id="trash_untrash_all" class="btn btn-small green">Tout sortir de la corbeille</button>
		<button id="trash_untrash_some" class="btn btn-small green">Sortir les sélectionnés</button>
		<button id="trash_confirm_some" class="btn btn-small red">Supprimer les sélectionnés</button>
		<button id="trash_confirm_all" class="btn btn-small red">Tout supprimer</button>
	</div>
</div>