@extends('iba::backend.base')

@section('main')

@component('modules.backend.create', ['bundles' => $bundles, 'type' => 'post', 'roles' => array('mention')])
	
	@slot('subtitle')
		disabled
	@endslot
	
	@slot('description')
		disabled
	@endslot
	
		<label>Idea</label>
        <select name="idea">
	        <option selected disabled hidden style='display: none' value=''></option>
	        @foreach ( $ideas as $idea )
	            <option value="{{ $idea->id }}">{{ $idea->title->value }}</option>
	        @endforeach
        </select>
	
@endcomponent

@endsection