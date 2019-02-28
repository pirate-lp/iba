@extends('atelier::window.master')

@push('title')
	<span>{{ title_case($type) }} \ <i>(new)</i></span>
@endpush

@section('main')

	<div style="overflow: visible;">
	
		{{--<h2>New {{ title_case($type) }}</h2>--}}
	
		<form class="atelier-main-form pure-form pure-form-aligned" action="/atelier/analog/{{ $type }}/" method="post">
		
			{{ csrf_field() }}
			
			<div class="form-actions">
				<button type="submit" class="btn btn-default">Create</button>
			</div>
			
			@include('atelier::modules.form.create')
			
		</form>
		
	</div>

@endsection