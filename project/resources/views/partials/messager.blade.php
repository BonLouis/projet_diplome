@if(session('successMsg'))
<script>
	document.addEventListener('DOMContentLoaded', bonjour => {
		M.toast({
			html: '{{ session('successMsg') }}',
			classes: 'green'
		})
	});
</script>
@elseif(session('errorMsg'))
<script>
	document.addEventListener('DOMContentLoaded', bonjour => {
		M.toast({
			html: '{{ session('errorMsg') }}',
			classes: 'red'
		})
	});
</script>
@endif