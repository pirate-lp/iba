@extends('atelier::window.master')

@push('title')
	{{--- <span class="h2">Editing {{ title_case($type) }}</span> --}}
	<span>{{ title_case($type) }}</span> \ <span>id: {{ $book->id }}</span>
@endpush

@section('main')
	<div>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
	
		<form class="atelier-main-form pure-form pure-form-aligned" action="/iatelier/analog/{{ $type }}/{{ $book->id }}/" method="POST">
			{{ method_field('PUT') }}
			{{ csrf_field() }}
		
			<div class="form-actions">
				<button type="submit" class="btn btn-default">Update</button>
			</div>
		
			@include('atelier::production.form.template')
			
		</form>
	</div>
@endsection
