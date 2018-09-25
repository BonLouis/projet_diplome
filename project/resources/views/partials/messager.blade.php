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
@elseif(session('infoMsg'))
<script>
	document.addEventListener('DOMContentLoaded', bonjour => {
		M.toast({
			html: '{{ session('infoMsg') }}',
			classes: 'blue'
		})
	});
</script>
@endif
{{-- Usefull for the admin part --}}
<script>
	function flash(level, html) {
		let classes;
		if (level === 'successMsg')
			classes = 'green';
		else if (level === 'errorMsg')
			classes = 'red';
		else if (level === 'infoMsg')
			classes = 'blue';
		M.toast({
			html,
			classes
		});
	}
</script>