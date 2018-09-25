<div id="search-modal" class="modal">
	<div class="modal-content" style="display: none">
		<i id="close" class="material-icons">close</i>
		<div id="search-results"></div>
	</div>
	<div class="modal-footer input-field" style="overflow: hidden">
		<div class="row">
			<div class="col s12">
				<i class="material-icons prefix">search</i>
				<input id="search" name="search" type="text" class="center-align h3" autocomplete="off">
				<label for="search">Votre recherche</label>
			</div>
		</div>
	</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', yiha => {
		let hint = true;
		$('#search-modal').modal({
			onOpenEnd() {
				// Simply always give the focus to the input
				// (html autofocus is not enough)
				$('#search').focus();
				$('#close').click(function(){$('#search-modal').modal('close')});
				// hint
				if (hint) {
					flash('infoMsg', 'Préfixez par "#" pour rechercher par catégories. Ex: "#css"');
					hint = false;
				}
			},
			onCloseEnd() {
				$('#search-results').html('');
				$('.modal-content').css('display', 'none');
				$('#search').val('');
				$('#search-modal').removeClass('modal-fixed-footer');
			}
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
					$('#search-modal').addClass('modal-fixed-footer');
					$('.modal-content').css('display', 'inherit');
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
				axios.get($(this).attr('href'), {
					params: {
						search: $('#search').val()
					}
				})
				.then(({ data }) => {
					$('#search-results').html('');
					$('#search-results').html(data);
					$('#search-results .tabs').tabs();
					handlePagination();
				})
				.catch(a => {
					console.log(a);
				})
			})
		}
	});
</script>