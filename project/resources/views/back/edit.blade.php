<form action="{{ route('post.update', $post) }}" method="POST" class="container" id="form-to-send" data-post-id="{{ $post->id }}">
	@method('PUT')
	@csrf
	{{-- FORM-ROW --}}
	<div class="row">
		{{-- END FORM-GROUP --}}
		{{-- FORM-GROUP --}}
		<div class="input-field col s6">
			<label for="title">Titre</label>
			<input id="title" name="title"  type="text"
			value="{{ old('title') ?? $post->title}}">
		</div>
		<div class="input-field col s6">
			<select id="type" name="type">
				<option
					@if($post->type === null) selected @endif
				disabled hidden>Type du cours</option>
				<option
					value="formation" @if(old('type') === 'formation' || $post->type === 'formation') selected @endif
				>Formation</option>
				<option
					value="stage" @if(old('type') === 'stage' || $post->type === 'stage') selected @endif
				>Stage</option>
			</select>
			<label for="type">Type</label>
		</div>
		{{-- END FORM-GROUP --}}
		{{-- FORM-GROUP --}}
	</div>
	<div class="row">
		
		{{-- END FORM-GROUP --}}
		{{-- FORM-GROUP --}}
		<div class="input-field col s6">
			<label for="price">Prix</label>
			<input id="price" name="price"  type="number"  step="1"  value="{{ old('price') ?? $post->price }}">
		</div>
		<div class="input-field col s4">
			<label for="max_seats">Places</label>
			<input id="max_seats" name="max_seats"  type="number"  {{-- min="1" max="65536" --}} step="1" value="{{ old('max_seats') ?? $post->max_seats }}">
		</div>
	</div>
	{{-- END FORM-GROUP --}}
	{{-- FORM-GROUP --}}
	<div class="row">
		<div class="input-field col s12">
			<textarea id="description" name="description" class="materialize-textarea">{{ old('description') ?? $post->description }}</textarea>
			<label for="description">Description</label>
		</div>
	</div>
	{{-- END FORM-ROW --}}
	{{-- FORM-ROW --}}
	<div class="row">
		{{-- END FORM-GROUP --}}
		{{-- FORM-GROUP --}}
		{{-- END FORM-GROUP --}}
		{{-- FORM-GROUP --}}
		<div class="input-field col s6">
			<label for="begin_at">Date de début</label>
			<input id="begin_at" name="begin_at" type="text" class="datepicker"
			value="{{ old('begin_at') ?? (new Carbon\Carbon($post->begin_at))->format("Y-m-d") }}">
		</div>
		<div class="input-field col s6">
			<label for="begin_at">Heure de début</label>
			<input id="begin_at" name="begin_at" type="text" class="timepicker"
			value="{{ old('begin_at') ?? (new Carbon\Carbon($post->begin_at))->format("H:i") }}">
		</div>
	</div>
	<div class="row">
		{{-- END FORM-GROUP --}}
		{{-- FORM-GROUP --}}
		<div class="input-field col s6">
			<label for="end_at">Date de fin</label>
			<input id="end_at" name="end_at" type="text" class="datepicker"
			value="{{ old('end_at') ?? (new Carbon\Carbon($post->end_at))->format("Y-m-d") }}">
		</div>
		<div class="input-field col s6">
			<label for="end_at">Heure de fin</label>
			<input id="end_at" name="end_at" type="text" class="timepicker"
			value="{{ old('end_at') ?? (new Carbon\Carbon($post->end_at))->format("H:i") }}">
		</div>
	</div>
	{{-- END FORM-ROW --}}
	{{-- FORM-ROW --}}
	<div class="row">
		{{-- END FORM-GROUP --}}
		{{-- FORM-GROUP --}}
		<div class="input-field col s6">
			<fieldset>
				<legend>Status</legend>
				<p>
					<label for="published">
						<input id="published" name="status" type="radio"  value="published"
						@if( (old('status') === 'published' || $post->status === 'published') && old('status') !== 'draft' ) checked @endif>
						<span>Publié</span>
					</label>
				</p>
				<p>
					<label for="draft">
						<input id="draft" name="status" type="radio"  value="draft"
						@if( (old('status') === 'draft' || $post->status === 'draft') && old('status') !== 'published' ) checked @endif>
						<span>Brouillon</span>
					</label>
				</p>
			</fieldset>
		</div>
		{{-- END FORM-GROUP --}}
		{{-- FORM-GROUP --}}
		<div class="input-field col s6">
			<fieldset>
				<legend>Inscriptions </legend>
				<p>
					<label for="is_open">
						<input id="is_open" name="open" type="radio"  value="1"
						@if( (old('open') == 1 || $post->open === 1) && old('open') !== '0' ) checked @endif>
						<span>Ouvertes</span>
					</label>
				</p>
				<p>
					<label for="is_not_open">
						<input id="is_not_open" name="open" type="radio"  value="0"
						@if( (old('open') == 0 || $post->open === 0) && old('open') !== '1' ) checked @endif>
						<span>Fermées</span>
					</label>
				</p>
			</fieldset>
		</div>
		{{-- END FORM-GROUP --}}
	</div>
	{{-- END FORM-ROW --}}
	<div class="row">
		<div class="col s6">
			<fieldset class="input-field file">
				<legend>Télécharger une image</legend>
				<div class="custom-file">
					<input id="picture_up" name="picture_up" type="file">
					<label class="custom-file-label" for="picture_up">Choisir un fichier</label>
				</div>
			</fieldset>
			<div class="input-field">
				<label for="picture_url">Ajouter une url</label>
				<input id="picture_url" name="picture_url" type="text" value="{{ old('picture_url') ?? $post->picture->link }}">
			</div>
		</div>
		<div class="col s6 d-flex align-items-center justify-content-center">
			<img src="{{$post->picture->link}}" width="200">
		</div>
	</div>
</form>
