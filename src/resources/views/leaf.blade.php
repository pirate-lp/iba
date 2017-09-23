@extends('iba::master')

@push('title') {{ $page['title'] }} | {{ $base['title'] }} @endpush

@if ( array_key_exists('description', $page) )
	@push('description'){{ $page['description'] }}@endpush
@endif

@section('cssclass', $base['template'])

@section('body')

@component('modules.layouts.header')
	@slot('title')
		<a href="/{{ $base['slug'] }}/">{{ title_case($base['title']) }}</a>
	@endslot
	
	<li><a href="/{{ $base['slug'] }}/">Index</a></li>
	
	@if ( isset($base['menu']) )
		@foreach ( $base['menu'] as $key => $value )
			@if ( is_array($value) )
				@foreach ( $value as $item => $vs )
					<li>
					<a href="/{{ $base['slug'] }}/{{ str_slug($item) }}/">{{ title_case($item) }}</a>
						<ul>
							@foreach ( $vs as $v => $k )
							<li><a href="/{{ $base['slug'] }}/{{ str_slug($item) }}/{{ str_slug($k) }}/">{{ title_case($k) }}</a></li>
							@endforeach
						</ul>
					</li>
				@endforeach
			@else
				<li><a href="/{{ $base['slug'] }}/{{ str_slug($value) }}/">{{ title_case($value) }}</a></li>
			@endif
		@endforeach
	@endif
	
@endcomponent

@section('main')

{!! $page['content'] !!}

@show

@if ( isset($page['style']) && $page['style'] == 'index' )
	@include('ideas.index', ['idea' => $page['title'] ])
@endif

@endsection



		