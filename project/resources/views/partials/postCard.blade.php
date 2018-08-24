@if(isset($details))
<div class="container-fluid d-flex flex-column" style="flex:1;">
	<div class="row" style="flex:1;">
		<div class="col-md-3"
			style="
			background-image: url('{{ $post->picture->link }}')
			">
			
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
			<li class="list-group-item">{{ $post->price }}</li>
		</div>
	</div>
</div>
@else
<div class="card m-5">
	<div class="card-header">
		<h2>
		{{ $post->ucType() }}
		</h2>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-4">
					<img src="{{ $post->picture->smallLink() }}" alt="{{ $post->picture->title }}" width="100%" height="200" style="object-fit:cover;">
				</div>
				<div class="col-md-4">
					<h5 class="card-title">{{ $post->title }}</h5>
					<p class="card-text">{{ $post->shortDescription(50) }}</p>
					<a href="{{ route('showPost', $post) }}" class="btn btn-primary">
						En savoir plus sur {{ $post->type === 'formation' ? 'cette' : 'ce' }} {{ $post->type }}
					</a>
				</div>
				<div class="col-md-4">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							@foreach($post->categories as $category)
							{{ $category->name }},
							@endforeach
						</li>
						<li class="list-group-item">Démarre dans {{ $post->remainingTimeString() }}.</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endif