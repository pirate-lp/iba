<article class="shadow" style="overflow: visible;">
<h2>New {{ title_case($type) }}</h2>

<form class="pure-form" action="/backend/{{ $type }}s/" method="post">
{{ csrf_field() }}
<div class="pure-g">

	<div class="pure-u-1 pure-u-md-5-8">
	    <fieldset class="pure-group" style="padding: 1rem;">
		    <legend>Main</legend>
	        <input name="title" type="text" class="pure-input-1" placeholder="A title">
	        <input name="subtitle" type="text" class="pure-input-1" placeholder="A Subtitle" {{ $subtitle or '' }}>
	        <input name="slug" class="pure-input-1" type="text" placeholder="a slug">
	        <input name="thumbnail[loc]" class="pure-input-1-2" type="text" placeholder="thumbnail[path]" {{ $thumbnail or '' }}>
	        <input name="thumbnail[name]" class="pure-input-1-2" type="text" placeholder="thumbnail[name]" {{ $thumbnail or '' }}>
	        <input name="thumbnail[photographer]" class="pure-input-1-2" type="text" placeholder="thumbnail[photographer]" {{ $thumbnail or '' }}>
	        <input name="thumbnail[name]" class="pure-input-1-2" type="text" placeholder="thumbnail[link]" {{ $thumbnail or '' }}>
	        <input name="description" class="pure-input-1" type="text" placeholder="Description" {{ $description or '' }}>
	        <textarea class="pure-input-1" placeholder="Textareas work too" name="content" {{ $textarea or '' }}></textarea>
	    </fieldset>
	</div>
	
	<div class="pure-u-1 pure-u-md-3-8">
		<fieldset class="pure-form-stacked" style="padding: 1rem;">
			<legend>Detail</legend>
	        <label>Keywords</label>
	        <input id="keywords" name="keywords" type="text">
	        <script>
				$(function() {
					var availableOptions = <?php echo $keywords->toJson(); ?>;
				    $('#keywords').selectize({
					    persist: false,
						createOnBlur: true,
						create: true,
						valueField: 'id',
						labelField: 'word',
						searchField: 'word',
						options: availableOptions
					});
				});
			</script>
			
			@if ( isset($bundles) )
				@foreach ( $bundles as $key => $values )
					<label>{{ $key }}</label>
					<select name="bundles[]">
		        		<option selected disabled value=''></option>
						@foreach ( $values as $value )
							<option value="{{ $value->id }}">{{ $value->title->value }}</option>
						@endforeach
					</select>
				@endforeach
			@endif
	
			<label>Date first written</label>
	        <input name="timestamp[draft]" type="date">
	        <label>Date published</label>
	        <input name="timestamp[publish]" type="date">
		</fieldset>
		
	</div>
	<div class="pure-u-1 pure-u-md-5-8">
	    <fieldset class="pure-group" style="padding: 1rem;">
		    <legend>People related data</legend>
		    @foreach ( $roles as $role )
			    <label>{{ title_case($role) }}</label>
			    <input id="{{ $role }}" name="people[{{ $role }}]" type="text">
		        <script>
					$(function() {
						var availableOptions = <?php echo $peoples->toJson(); ?>;
					    $('#{{ $role }}').selectize({
						    persist: false,
						    createOnBlur: true,
						    create: true,
							valueField: 'id',
							labelField: 'name',
							searchField: 'name',
							options: availableOptions,
						});
					});
				</script>
		    @endforeach
	    </fieldset>
	</div>
	<div class="pure-u-1 pure-u-md-3-8">
		<fieldset class="pure-group" style="padding: 1rem;">
		    <legend>Specific extra data</legend>

	    </fieldset>
	</div>
	
</div>
    <button type="submit" class="pure-button pure-input-1-2 pure-button-primary">Create</button>
</form>
</article>