@extends('iba::base')

@push('title')
Editing {{ title_case($type) }}
@endpush

@section('main')
<article>
@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<form class="iba-main-form" action="/iba/analog/{{ $type }}/{{ $book->id }}/" method="POST">
	{{ method_field('PUT') }}
	{{ csrf_field() }}

	<div class="" style="overflow:auto;">
		<span class="h2">{{ title_case($type) }} | </span><span class="h3">ID: {{ $book->id }}</span>
		<button type="submit" class="pure-button pure-button-primary" style="float: right; display: block;">Update</button>
	</div>

	@include('iba::modules.form.edit')

</form>
</article>
@endsection
