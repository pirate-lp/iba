@extends('iba::backend.base')

@section('main')

@component('modules.backend.edit', ['object' => $poem, 'bundles' => $bundles, 'type' => 'poem', 'roles' => array('inspired', 'author', 'dedicated')])
	
	@slot('subtitle')
		disabled
	@endslot
	
	@slot('description')
		disabled
	@endslot
	
	@slot('thumbnail')
		disabled
	@endslot
	
@endcomponent

@endsection