@includeWhen(method_exists($posts, 'links'), 'partials.paginate', compact('posts'))
{{--
	This is a fix for the tab initialization.
	When we make a research, if a card already on the main page appear,
	It will not be properly init due to same tab ids.
	It's not anymore a problem with a random id suffix.
--}}
{{ $randId = uniqid() }}
<div class="row">
	@foreach($posts as $post)
	<div class="col s12 m6">
		<div class="card large hoverable" style="height: 465px;">
			<div class="card-image">
				<img src="{{ $post->picture->link }}" style="min-height: 280px;">
				<span class="card-title">{{ $post->title }}</span>
			</div>
			<div class="card-fab">
				<a class="btn-floating halfway-fab waves-effect waves-light red tooltipped"
					data-position="bottom"
					data-tooltip="En savoir plus sur {{ $post->type === 'formation' ? 'cette' : 'ce' }} {{ $post->type }}"
					href="{{ route('showPost', $post) }}
				">
					<i class="material-icons">add</i>
				</a>
			</div>
			<div class="card-content">
				<p class="truncate">{{ $post->description }}</p>
			</div>
			<div class="card-tabs">
				<ul class="tabs tabs-fixed-width">
					<li class="tab">
						<a href="#begin{{ $post->id.'-'.$randId }}">
							<i class="material-icons">access_time</i>
						</a>
					</li>
					<li class="tab">
						<a href="#seats{{ $post->id.'-'.$randId }}">
							<i class="material-icons">event_seat</i>
						</a>
					</li>
					<li class="tab">
						<a href="#tags{{ $post->id.'-'.$randId }}">
							<i class="material-icons" style="vertical-align:top; font-weight:bold">#</i>
						</a>
					</li>
				</ul>
			</div>
			<div class="card-content grey lighten-4">
				<div id="begin{{ $post->id.'-'.$randId }}">Démarre dans {{ $post->remainingTimeString() }}</div>
				<div id="seats{{ $post->id.'-'.$randId }}">{{ $post->max_seats }} places</div>
				<div id="tags{{ $post->id.'-'.$randId }}">
					@foreach($post->categories as $i => $category)
					{{-- We will use $i for the comma gestion
					by seeing if we are iterating through the last item --}}
					{{ $category->name . ($i + 1 !== $post->categories()->count() ? ', ' : '')}}
					@endforeach</div>
			</div>
		</div>
	</div>
	@endforeach
</div>

@includeWhen(method_exists($posts, 'links'), 'partials.paginate', compact('posts'))
