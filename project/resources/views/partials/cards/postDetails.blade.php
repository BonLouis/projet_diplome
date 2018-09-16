<div class="over-wrapper-container flex aic" id="bandeau">
	<ul class="flex jcsa aic">
		<li>{{ $post->type }}</li>
		<li class="divider"></li>
		@foreach($post->categories as $i => $category)
		<li>
			{{ $category->name . ($i + 1 !== $post->categories()->count() ? ', ' : '')}}
		</li>
		@endforeach
	</ul>
</div>







<img src="{{ $post->picture->link }}">
<span class="card-title">{{ $post->title }}</span>
<p class="truncate">{{ $post->description }}</p>
<div id="begin{{$post->id}}">Démarre dans {{ $post->remainingTimeString() }}</div>
<div id="seats{{$post->id}}">{{ $post->max_seats }} places</div>
@foreach($post->categories as $i => $category)
{{ $category->name . ($i + 1 !== $post->categories()->count() ? ', ' : '')}}
@endforeach</div>
{{-- 

###

 --}}
<div class="container-fluid d-flex flex-column" style="flex:1;">
<div class="row" style="flex:1;">
	<div class="col-md-3"
		style="
		background-image: url('{{ $post->picture->link }}')">
	</div>
	<div class="col-md-5 align-self-center">
		<h1>{{ $post->title }}</h1>
		<p class="text-justify">{{ $post->description }}</p>
		
	</div>
	<div class="col-md-4 list-group align-self-center">
		<li class="list-group-item">{{ $post->ucType() }}</li>
		<li class="list-group-item">Commence le {{ $post->begin_at }}</li>
		<li class="list-group-item">Fini le {{ $post->end_at }}</li>
		<li class="list-group-item">{{ $post->max_seats }} places</li>
		<li class="list-group-item">{{ $post->priceWithCurrency() }}</li>
	</div>
</div>
</div>