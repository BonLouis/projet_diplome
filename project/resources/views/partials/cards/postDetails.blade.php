<div class="over-wrapper-container blue-grey lighten-1 flex aic jcc" id="bandeau">
	<h3 class="valign-wrapper my-2 white-text">{{ ucfirst($post->type) }} - {{ ucfirst($post->title) }}</h3>
</div>
<div id="bg" style="background-image: url('{{ $post->picture->link }}')">
	<div id="overlay" style="background-color: rgba(255,255,255,.5)">
		<div class="row">
			<div class="col s12">
				<fieldset>
					<legend>Description</legend>
					<p>
						{{ $post->description }}
					</p>
				</fieldset>
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<fieldset>
					<legend>Date de début</legend>
					<p>
						{{ $post->begin_at }}
					</p>
				</fieldset>
			</div>
			<div class="col s6">
				<fieldset>
					<legend>Date de fin</legend>
					<p>
						{{ $post->end_at }}
					</p>
				</fieldset>
			</div>
		</div>
		<div class="row">
			<div class="col s6">
				<fieldset>
					<legend>Nombres de places</legend>
					<p>
						{{ $post->max_seats }}
					</p>
				</fieldset>
			</div>
			<div class="col s6">
				<fieldset>
					<legend>Prix</legend>
					<p>
						{{ $post->priceWithCurrency() }}
					</p>
				</fieldset>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<fieldset>
					<legend>Tags</legend>
					<p>
						@foreach($post->categories as $i => $category)
						{{ $category->name . ($i + 1 !== $post->categories()->count() ? ', ' : '')}}
						@endforeach
					</p>
				</fieldset>
			</div>
		</div>
		<div id="begin{{$post->id}}">Démarre dans {{ $post->remainingTimeString() }}</div>
	</div>
</div>