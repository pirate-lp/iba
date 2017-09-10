@extends('master')

@section('body')

@component('modules.layouts.header')
	@slot('title')
		<a href="/{{ $base['slug'] }}/">{{ title_case($base['title']) }}</a>
	@endslot
	
	@if ( isset($base['menu']) )
		@foreach ( $base['menu'] as $menu )
			<li><a href="/{{ $base['slug'] }}/{{ str_slug($menu) }}/">{{ title_case($menu) }}</a></li>
		@endforeach
	@endif
	
@endcomponent

@yield('content')

@endsection


		