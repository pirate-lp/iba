@extends('iba::backend.base')

@section('main')

@component('modules.backend.index-table', ['type' => 'article', 'items' => $articles,  ] )
	@slot('bundle-titles')
		<th>Issue</th>
	@endslot
@endcomponent

@endsection