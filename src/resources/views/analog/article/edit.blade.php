@extends('iba::backend.base')

@section('main')

@component('modules.backend.edit', ['object' => $article, 'bundles' => $bundles, 'type' => 'article', 'roles' => array('author', 'mention')])
	
	<label>Position</label>
	<input name="position" type="number" value="{{ $article->position->issue }}">
	
@endcomponent

@endsection