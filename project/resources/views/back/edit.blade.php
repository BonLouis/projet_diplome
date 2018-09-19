<form action="{{ $post->id ? route('post.update', $post) : route('post.store') }}" method="POST" class="container" id="form-to-send" data-post-id="{{ $post->id ?? '' }}">
	@method($post->id ? 'PUT' : 'POST')
	@csrf
	{{-- FORM-ROW --}}
	<div class="row">
		{{-- END FORM-GROUP --}}
		{{-- FORM-GROUP --}}
		<div class="input-field col s6">
			<input id="title" name="title"  type="text"
			value="{{ old('title') ?? $post->title}}">
			<label for="title">Titre</label>
			<span class="helper-text"></span>
		</div>
		<div class="input-field col s6">
			<select required id="type" name="type">
				<option
					@if($post->type === null) selected @endif
				disabled hidden>Type du cours</option>
				<option
					value="formation" @if(old('type') === 'formation' || $post->type === 'formation' || !$post->id) selected @endif
				>Formation</option>
				<option
					value="stage" @if(old('type') === 'stage' || $post->type === 'stage') selected @endif
				>Stage</option>
			</select>
			<label for="type">Type</label>
			<span class="helper-text"></span>
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
			<span class="helper-text"></span>
		</div>
		<div class="input-field col s4">
			<label for="max_seats">Places</label>
			<input id="max_seats" name="max_seats"  type="number"  {{-- min="1" max="65536" --}} step="1" value="{{ old('max_seats') ?? $post->max_seats }}">
			<span class="helper-text"></span>
		</div>
	</div>
	{{-- END FORM-GROUP --}}
	{{-- FORM-GROUP --}}
	<div class="row">
		<div class="input-field col s12">
			<textarea id="description" name="description" class="materialize-textarea">{{ old('description') ?? $post->description }}</textarea>
			<label for="description">Description</label>
			<span class="helper-text"></span>

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
			<label for="_begin_at_date">Date de début</label>
			<input id="_begin_at_date" type="text" class="datepicker"
			value="{{ old('begin_at') ?? (new Carbon\Carbon($post->begin_at))->format("Y-m-d") }}">
			<span class="helper-text"></span>

		</div>
		<div class="input-field col s6">
			<label for="_begin_at_hour">Heure de début</label>
			<input id="_begin_at_hour" type="text" class="timepicker"
			value="{{ old('begin_at') ?? (new Carbon\Carbon($post->begin_at))->format("H:i") }}">
			<span class="helper-text"></span>

		</div>
	</div>
	<div class="row">
		{{-- END FORM-GROUP --}}
		{{-- FORM-GROUP --}}
		<div class="input-field col s6">
			<label for="_end_at_date">Date de fin</label>
			<input id="_end_at_date" type="text" class="datepicker"
			value="{{ old('end_at') ?? (new Carbon\Carbon($post->end_at))->format("Y-m-d") }}">
			<span class="helper-text"></span>
		</div>
		<div class="input-field col s6">
			<label for="_end_at_hour">Heure de fin</label>
			<input id="_end_at_hour" type="text" class="timepicker"
			value="{{ old('end_at') ?? (new Carbon\Carbon($post->end_at))->format("H:i") }}">
			<span class="helper-text"></span>
		</div>
	</div>
	<div class="row">
		{{-- END FORM-GROUP --}}
		{{-- FORM-GROUP --}}
		<div class="input-field col s6">
			<input type="hidden" name="begin_at">
			<span class="helper-text"></span>
		</div>
		<div class="input-field col s6">
			<input name="end_at" type="hidden">
			<span class="helper-text"></span>
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
						@if( ((old('status') === 'draft' || $post->status === 'draft') && old('status') !== 'published' ) || !$post->id) checked @endif>
						<span>Brouillon</span>
						<span class="helper-text"></span>
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
						<span class="helper-text"></span>
					</label>
				</p>
			</fieldset>
		</div>
		{{-- END FORM-GROUP --}}
	</div>
	{{-- END FORM-ROW --}}
	<div class="row">
		<div class="col s6">
			{{-- <fieldset class="input-field file">
				<legend>Télécharger une image</legend>
				<div class="custom-file">
					<input id="picture_up" name="picture_up" type="file">
					<label class="custom-file-label" for="picture_up">Choisir un fichier</label>
				</div>
			</fieldset> --}}
			<div class="input-field">
				<label for="picture_url">Url vers une image</label>
				{{-- Dont use old() here, it's a pain if we trigger the error without
				be able to retrieve the original url to dismiss the error --}}
				<input id="picture_url" name="picture_url" type="text" value="{{ $post->picture->link ?? '' }}">
				<span class="helper-text"></span>
			</div>
		</div>
		<div class="col s6 d-flex align-items-center justify-content-center">
			<img src="{{ $post->picture->link ?? 'https://dummyimage.com/600x400/ccc/000&text=Votre future image'}}" width="200">
		</div>
	</div>
</form>
