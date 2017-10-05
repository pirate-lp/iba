@extends('iba::base')

@push('title')
Managing {{ title_case($type) }}
@endpush

@section('main')

<article class="shadow" style="overflow: visible;">
	<header>
		<h2>{{ title_case($type) }} | List of all</h2>
	</header>
	<table class="pure-table">
	    <thead>
	        <tr>
	            <th>#</th>
	            <th>Title</th>
	            <th>Date</th>
	        </tr>
	    </thead>
	
	    <tbody>
		    @foreach ( $items as $item )
	        <tr>
	            <td>{{ $item->id }}</td>
	            <td><a href="/iba/analog/{{ $type }}/{{ $item->id }}/edit/">{{ $item->title->value }}</a></td>
	            <td>{{ $item->timestamp->publish or '' }}</td>
	        </tr>
	        @endforeach
	    </tbody>
	</table>
</article>

@endsection