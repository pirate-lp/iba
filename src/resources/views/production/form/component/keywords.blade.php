			<div class="c-card__item c-card__item--divider">Keywords</div>
			<div class="c-card__item">
				<input id="keywords" name="keywords" style="display: none;">
				<div id="keywords-field" name="keywords" type="text" style="width: 100%; display: block;"></div>
			</div>
			<script>
				$(function() {
					var availableOptions = <?php echo $keywords->toJson(); ?>;
					var selectedOptions = ''
					
					@if( isset($book) && method_exists($book, 'keywords'))
						selectedOptions = <?php echo $book->keywords()->pluck('keywords.id')->toJson(); ?>;
						var value = <?php echo $book->keywords()->get()->toJson(); ?>;
						$('#keywords').val([JSON.stringify(value)]);
					@endif
					
					$('#keywords-field').selectize({
						persist: false,
						createOnBlur: true,
						create: function(input) {
							return {
								id: 'new' + input,
								word: input,
							};
						},
						valueField: 'id', 
						labelField: 'word',
						searchField: 'word',
						render: {
							item: function(data, escape) {
								return "<div class='selected-keyword' data-data='"+JSON.stringify(data)+"'>"
									+ data.word
									+ '</div>';
							}
						},
						options: availableOptions,
						items: selectedOptions,
						onChange: function(value) {
							
							var keywords = $('.selected-keyword').map(function(){
								return $(this).attr('data-data');
							}).get().join();
							
							$('#keywords').val('['+keywords+']');
						}
					});
				});
			</script>