<ul class="pagination center-align">
	<li class="{{ ($posts->currentPage() == 1) ? 'disabled' : 'waves-effect' }}">
		<a href="{{
			$posts->currentPage() !== 1
			? $posts->url($posts->currentPage() - 1)
			: 'javascript:void(0)'
		}}">
			<i class="material-icons">chevron_left</i>
		</a>
	</li>

	@for($i = 1; $i <= $posts->lastPage(); $i++)
	<li class="waves-effect {{$posts->currentPage() === $i ? 'active' : ''}}">
		<a href="{{$posts->url($i)}}">{{$i}}</a>
	</li>
	@endfor
	
	<li class="{{ ($posts->currentPage() === $posts->lastPage()) ? 'disabled' : 'waves-effect' }}">
		<a href="{{
			$posts->currentPage() !== $posts->lastPage()
			? $posts->url($posts->currentPage() + 1)
			: 'javascript:void(0)'
		}}">
			<i class="material-icons">chevron_right</i>
		</a>
	</li>
</ul>
