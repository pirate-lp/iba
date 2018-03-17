@extends('iba::window.master')

@push('title')
	<span>{{ title_case($type) }} \ <i>(new)</i></span>
@endpush

@section('main')

	<div style="overflow: visible;">
	
		{{--<h2>New {{ title_case($type) }}</h2>--}}
	
		<form class="iba-main-form pure-form pure-form-aligned" action="/iba/analog/{{ $type }}/" method="post">
		
			{{ csrf_field() }}
			
			@include('iba::modules.form.create')
			
			<button type="submit" class="pure-button pure-button-primary">Create</button>
			
		</form>
		
	</div>

@endsection