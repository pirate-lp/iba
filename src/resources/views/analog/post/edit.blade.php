@extends('iba::backend.base')

@section('main')

@component('modules.backend.edit', ['object' => $post, 'bundles' => $bundles, 'type' => 'post','roles' => array('mention')])
	
	@slot('subtitle')
		disabled
	@endslot
	
	@slot('description')
		disabled
	@endslot
	
		<label>Idea</label>
        <?php $post_idea = $post->ideas()->first(); ?>
		<select name="idea">
        	<option hidden style='display: none' value=''></option>
	        @foreach ( $ideas as $idea )
	            <option value="{{ $idea->id }}"
	            
	            @if ( $post_idea && $post_idea->title->value == $idea->title->value )
	            	selected
	            @endif
	            >{{ $idea->title->value }}</option>
	        @endforeach
        </select>
	
@endcomponent

@endsection