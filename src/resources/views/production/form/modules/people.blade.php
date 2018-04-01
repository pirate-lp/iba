	<div class="c-card__item c-card__item--divider">People related data</div>
	
	<script>
		var availablePeople = <?php echo $peoples->toJson(); ?>;
	</script>
		
	@foreach ( $roles as $role )
		
		<div class="c-card__item">
			<div class="os-form-group">
				<label>{{ title_case($role) }}: </label>
				<input id="{{ $role }}" name="people[{{ $role }}]" type="text" style="display: none;">
				<div id="{{ $role }}-field" class="form-control select-correction"></div>
			</div>
			<script>
				$(function() {
					var selectedOptions = '';
					
					@if( isset($book) && method_exists($book, 'peoples'))
						selectedOptions = <?php echo $book->peoples($role)->get()->pluck('id')->toJson(); ?>;
						var value = <?php echo $book->peoples($role)->get()->toJson(); ?>;
						$('#{{ $role }}').val([JSON.stringify(value)]);
					@endif
					
					$('#{{ $role }}-field').selectize({
						persist: false,
						createOnBlur: true,
						create: function(input) {
							return {
								id: 'new' + input,
								name: input,
							};
						},
						render: {
							item: function(data, escape) {
								return "<div class='selected-{{ $role }}' data-data='"+JSON.stringify(data)+"'>"
									+ data.name
									+ '</div>';
							}
						},
						valueField: 'id',
						labelField: 'name',
						searchField: 'name',
						options: availablePeople,
						items: selectedOptions,
						onChange: function(value) {
							let people = $('.selected-{{ $role }}').map(function(){
									return $(this).attr('data-data');
								}).get().join();
							
							$('#{{ $role }}').val('['+people+']');
							
						},
					});
				});
			</script>
		</div>
	@endforeach