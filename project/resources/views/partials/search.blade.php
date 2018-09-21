<div id="search-modal" class="modal">
	<div class="modal-content">
		<div class="row">
			<div class="input-field col s12">
				<i class="material-icons prefix">search</i>
				<input id="search" name="search" type="text">
				<label for="search">Votre recherche</label>
			</div>
		</div>
		<div id="search-results"></div>
	</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', yiha => {
		$('#search-modal').modal({
			onOpenEnd() {
				// Simply always give the focus to the input
				// (html autofocus is not enough)
				$('#search').focus();
			},
			// onCloseEnd() {
			// 	$('#search-results').html('');
			// 	$('#search').val('');
			// }
		});
		$('#search-modal').keypress(function(e) { // "on.('enter', ..."
			if (e.which === 13) {
				axios.get('/search', {
					params: {
						search: $('#search').val()
					}
				})
				.then(({ data }) => {
					$('#search-results').html('');
					$('#search-results').html(data);
					handlePagination();
					$('#search-results .tabs').tabs();
				})
				.catch(a => {
					console.log(a);
				})
			}
		});
		function handlePagination() {
			$('.pagination a').click(function(e) {
				e.preventDefault();
				axios.get($(this).attr('href'))
				.then(({ data }) => {
					$('#search-results').html('');
					$('#search-results').html(data);
					$('#search-results .tabs').tabs();
				})
				.catch(a => {
					console.log(a);
				})
			})
		}
	});
</script>