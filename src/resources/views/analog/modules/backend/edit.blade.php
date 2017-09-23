@extends('iba::backend.base')

@section('main')

<article class="shadw">
<h2>New post</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="pure-form pure-form-stacked" action="/backend/{{ $type }}s/{{ $object->id }}/" method="POST">
{{ method_field('PUT') }}
{{ csrf_field() }}

<div class="pure-g">
	<div class="pure-u-1-1 pure-u-md-5-8">
		@if ( !isset($thumbnail))
			<fieldset class="">
				<legend>Thumbnail</legend>
				<input placeholder="location of file" class="pure-input-1-2" type="text" name="thumbnail[path]" value="{{ $object->thumbnail->path or '' }}">
			    <input placeholder="File name" class="pure-input-1-2" type="text" name="thumbnail[name]" value="{{ $object->thumbnail->name or '' }}">
			    <input placeholder="Photographer" class="pure-input-1-2" type="text" name="thumbnail[photographer]" value="{{ $object->thumbnail->photographer or '' }}">
			    <input placeholder="Link to photographer's profile" class="pure-input-1-2" type="text" name="thumbnail[link]" value="{{ $object->thumbnail->link or '' }}">
			</fieldset>
		@endif
		
	    <fieldset class="pure-group">
		    <legend>Main parts</legend>
	        <input name="title" type="text" class="pure-input-3-4" placeholder="A title" value="{{ $object->title->value or ''}}">
	        <input name="slug" class="pure-input-3-4" type="text" placeholder="a slug" value="{{ $object->slug->value or '' }}">
	        <input name="subtitle" class="pure-input-3-4" type="text" placeholder="Subtitle" value="{{ $object->subtitle->value or '' }}">
		    <input name="description" class="pure-input-1" type="text" placeholder="Description" value="{{ $object->description->value or '' }}" {{ $description or '' }}>
		    <textarea class="pure-input-1" placeholder="Textareas work too" name="content" {{ $textarea or '' }}></textarea>
	    </fieldset>
	    
	    <fieldset class="pure-group" style="padding: 1rem;">	
	    	<legend>People related data</legend>
			@foreach ( $roles as $role )
			    <label>{{ title_case($role) }}</label>
			    <input id="{{ $role }}" name="people[{{ $role }}]" type="text">
			    <script>
				    $(function() {
					    var availableOptions = <?php echo $peoples->toJson(); ?>;
					    var selectedOptions = <?php echo $object->peoples($role)->get()->pluck('id')->toJson(); ?>;
					    $('#{{ $role }}').selectize({
						    persist: false,
						    createOnBlur: true,
						    create: true,
						    valueField: 'id',
						    labelField: 'name',
						    searchField: 'name',
						    options: availableOptions,
						    items: selectedOptions,
						});
					});
				</script>
			@endforeach
		</fieldset>
	</div>
	<div class="pure-u-1-1 pure-u-md-3-8">
		<fieldset class="">
			<legend>Additional detail</legend>
	        <label>Keywords</label>
	        <input id="keywords" name="keywords" type="text" value="">
	        
	        <script>
				$(function() {
					var availableOptions = <?php echo $keywords->toJson(); ?>;
					var selectedOptions = <?php echo $object->keywords()->pluck('keywords.id')->toJson(); ?>;
				    $('#keywords').selectize({
					    persist: false,
						createOnBlur: true,
						create: true,
						valueField: 'id',
						labelField: 'word',
						searchField: 'word',
						options: availableOptions,
						items: selectedOptions,
					});
				});
			</script>
	        
	       		@foreach ( $bundles as $key => $values )
					<label>{{ $key }}</label>
					<select name="bundles[]">
		        		<option selected disabled value=''></option>
						@foreach ( $values as $value )
							<option value="{{ $value->id }}"
							@if ($object->bundleSingle($key))
								@if ( $object->bundleSingle($key)->title->value == $value->title->value )
					            	selected
					            @endif
					        @endif
							>{{ $value->title->value }}</option>
						@endforeach
					</select>
				@endforeach
				
	        {{--<label>Category</label>
	        <select name="bundles[]">
		        @foreach ( $categories as $category )
		            <option value="{{ $category->id }}"
		            @if ( $object->bundleSingle('category')->title->value == $category->title->value )
		            	selected
		            @endif
		            >{{ $category->title->value }}</option>
		        @endforeach
	        </select>--}}
			<label>Date first written</label>
	        <input name="timestamp[draft]" type="date" 
	        	@if ( isset($object->timestamp->draft) )
	        		value="{{ $object->timestamp->draft->toDateString() }}"
	        	@endif
	        >
	        <label>Date published</label>
	        <input name="timestamp[publish]" type="date" @if ( isset($object->timestamp->publish) )
	        		value="{{ $object->timestamp->publish->toDateString() }}"
	        	@endif
	        >
		</fieldset>
		<fieldset class="pure-group" style="padding: 1rem;">
		    <legend>Specific extra data</legend>
		    {{ $slot }}
	    </fieldset>
	</div>
    <button type="submit" class="pure-button pure-input-1-2 pure-button-primary">Update</button>
</form>
</article>

@endsection
