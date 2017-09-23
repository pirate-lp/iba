@extends('iba::backend.base')

@section('main')

@component('modules.backend.create', ['bundles' => $bundles, 'type' => 'article', 'roles' => array('author', 'mention') ] )
	
	<label>Position</label>
	<input name="position" type="number" value="2">
	
@endcomponent



@endsection