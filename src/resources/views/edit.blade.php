@extends('iba::base')

@push('title')
{{--- Editing {{ title_case($type) }} --}}
<span class="h2">{{ title_case($type) }} | </span><span class="h3">ID: {{ $book->id }}</span>
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
	
		<form class="iba-main-form pure-form pure-form-aligned" action="/iba/analog/{{ $type }}/{{ $book->id }}/" method="POST">
			{{ method_field('PUT') }}
			{{ csrf_field() }}
		
			
		
			@include('iba::modules.form.edit')
			
			<button type="submit" class="pure-button pure-button-primary">Update</button>
			
		</form>
	</div>
@endsection
