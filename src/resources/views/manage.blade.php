@extends('iba::window.master')

@push('title')
{{ title_case($type) }}<!-- | manage-->
@endpush

@section('main')
<div class="pane padded-bottom-more" style="overflow: visible;">
<!--
	<header>
		<h2>{{ title_case($type) }} | List of all</h2>
	</header>
-->
	 <table class="table-striped">
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
</div>

@endsection