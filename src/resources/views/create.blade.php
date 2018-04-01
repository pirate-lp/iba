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
			<div class="form-actions">
				<button type="submit" class="btn btn-default">Create</button>
			</div>
		</form>
		
	</div>

@endsection