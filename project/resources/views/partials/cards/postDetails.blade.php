
@section('css')
	<link rel="stylesheet" href="{{ asset('font/css/all.css') }}">
@endsection

@section('title')
	{{ ucfirst($post->type) }} <br>
	- <br>
	{{ $post->title }} <br>
	<span class="little-text italic">
		Démarre dans {{ $post->remainingTimeString() }}
	</span>
@endsection
<div class="container">
	<p id="description" class="flow-text">{{ $post->description }}</p>
</div>
<div id="bandeau">
<div class="container valign-wrapper row">
		<div class="col m12 l6" id="img-container">
			<div>
				<img src="{{ $post->picture->link }}" alt="{{ $post->picture->title }}" class="responsive-img z-depth-3">
			</div>
		</div>
		<div class="col m12 l6">
			<ul class="collection z-depth-3">
				<li class="collection-item valign-wrapper"><i class="fal fa-euro-sign"></i> Coûte {{ $post->dotPrice() }} euros</li>
				<li class="collection-item valign-wrapper"><i class="material-icons">timer</i> Commence le {{ $post->humanBegin() }}</li>
				<li class="collection-item valign-wrapper"><i class="material-icons">timer_off</i> Fini le {{ $post->humanEnd() }}</li>
				<li class="collection-item valign-wrapper"><i class="material-icons">group_add</i> 
					@if($post->freeSeats()) Il reste {{ $post->freeSeats() }} places
					@else Il ne reste plus de place
				@endif</li>
				<li class="collection-item valign-wrapper"><i class="material-icons">group</i> 
					@if($post->takenSeats()) {{ $post->takenSeats() }} personnes sont inscrites
					@else Personne n'est inscrit
				@endif</li>
			</ul>
		</div>
	</div>
</div>
<div class="row center-align container">
	<div class="col s12 l4 offset-l4">
		<ul id="tags">
			@foreach($post->categories as $i => $category)
			<li>{{ $category->name }}</li>
			@endforeach
		</ul>
	</div>
</div>
