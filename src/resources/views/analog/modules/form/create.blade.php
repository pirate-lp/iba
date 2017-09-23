<div class="pure-g">
	<div class="pure-u-1-1 pure-u-md-5-8">
		
		<div style="margin: 0.4rem;">
	
		@if (in_array('title', $book->dimensions))
			<div class="control field is-horizontal">
				<div class="field-label is-small"><label class="label">Title</label></div>
				<input name="title" type="text" class="input" placeholder="A title">
			</div>
		@endif
		
		@if (in_array('subtitle', $book->dimensions))
			<div class="control field is-horizontal">
				<div class="field-label is-small"><label class="label">Subtitle</label></div>
				<input name="subtitle" type="text" class="input" placeholder="A title">
			</div>
		@endif
		
		@if (in_array('slug', $book->dimensions))
			<div class="control field is-horizontal">
				<div class="field-label is-small"><label class="label">Slug</label></div>
				<input name="slug" type="text" class="input" placeholder="A title">
			</div>
		@endif
		
		@if (in_array('description', $book->dimensions))
			<div class="field is-horizontal">
				<div class="field-label is-small"><label class="label">Description</label></div>
				<div class="field-body">
					<textarea name="description" class="textarea input" type="text" placeholder="Description"></textarea>
				</div>
			</div>
		@endif
			
			<textarea class="textarea" placeholder="Textareas work too" name="content"></textarea>
	
		</div>
		
		<div class="panel">
			<p class="panel-heading">People related data</p>
			<script>
				var availablePeople = <?php echo $peoples->toJson(); ?>;
			</script>
			
			@foreach ( $roles as $role )
			
			<div class="panel-block">
				<div class="control field">
					<label class="label is-small">{{ title_case($role) }}</label>
					<input id="{{ $role }}" name="people[{{ $role }}]" type="text" style="display: none;">
					<div id="{{ $role }}-field"></div>
				</div>
				<script>
					$(function() {
						var selectedOptions = '';
						console.log($('#{{ $role }}-field').selectize({
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
									let people = $('.selected-{{ $role }}').map(function(){return $(this).attr('data-data');}).get().join();
									$('#{{ $role }}').val('['+people+']');
								},
							}));
						});
				</script>
			</div>
			@endforeach
			
		</div>
		
	</div>
	
	<div class="pure-u-1-1 pure-u-md-3-8">
		
		@if ( !isset($thumbnail))
		<div class="panel">
			<p class="panel-heading">Thumbnail</p>
			<div class="panel-block">
				<input placeholder="location of file" class="input" type="text" name="thumbnail[path]">
				<input placeholder="File name" class="input" type="text" name="thumbnail[name]">
			</div>
			<div class="panel-block">
				<input placeholder="Photographer" class="input" type="text" name="thumbnail[photographer]">
				<input placeholder="Link to photographer's profile" class="input" type="text" name="thumbnail[link]">
			</div>
		</div>
		@endif
		
		<div class="panel">
			<p class="panel-heading">Keywords</p>
			<div class="panel-block">
				<input id="keywords" name="keywords" style="display: none;">
				<div id="keywords-field" name="keywords" type="text" style="width: 100%; display: block;"></div>
			</div>
			<script>
				$(function() {
					var availableOptions = <?php echo $keywords->toJson(); ?>;
					var selectedOptions = ''
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
							var keywords = $('.selected-keyword').map(function(){return $(this).attr('data-data');}).get().join();
							$('#keywords').val('['+keywords+']');
						}
					});
				});
			</script>
		</div>
	
		<div class="panel">
			<p class="panel-heading">Bundles</p>
			@if ( isset($bundles) )
	   			@foreach ( $bundles as $key => $values )
					<div class="panel-block">
						<div class="control field is-horizontal">
							<div class="field-label is-small"><label class="label">{{ $key }}</label></div>
							<select name="bundles[]" class="input">
								<option value=''></option>
							@foreach ( $values as $value )
								<option value="{{ $value->toJson() }}"
								>
									{{ $value->title->value }}
								</option>
							@endforeach
							</select>
						</div>
					</div>
				@endforeach
			@endif
		</div>	

		<div class="panel">
			<p class="panel-heading">Dates</p>
			<div class="panel-block">
				<div class="control field is-horizontal">
					<div class="field-label is-small"><label class="label">Draft</label></div>
					<input class="input" name="timestamp[draft]" type="date" >
				</div>
			</div>
			<div class="panel-block">
				<div class="control field is-horizontal">
					<div class="field-label is-small"><label class="label">Published</label></div>
					<input class="input" name="timestamp[publish]" type="date" >
				</div>
			</div>
			<div class="panel-block">
				<div class="control field is-horizontal">
					<div class="field-label is-small"><label class="label">Amended</label></div>
					<input class="input" name="timestamp[amend]" type="date" >
				</div>
			</div>
		</div>
	</div>
</div>