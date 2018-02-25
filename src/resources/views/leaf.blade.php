@extends('iba::master')

@push('title') {{ $leaf['title'] }} | {{ $base['title'] }} @endpush

@if ( array_key_exists('description', $leaf) )
	@push('description'){{ $leaf['description'] }}@endpush
@endif

@section('cssclass')
	@if(array_key_exists('template',$leaf))
		{{ $leaf['template'] }}
	@endif
	@if (isset($base))
		@if(array_key_exists('template',$base))
			{{ $base['template'] }}
		@endif
	@endif
@endsection

@section('body')

{{--@component('modules.layouts.header')
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
	
@endcomponent--}}

@section('main')

{!! $leaf['content'] !!}

@show

@if ( isset($leaf['style']) && $leaf['style'] == 'index' )
	@include('ideas.index', ['idea' => $leaf['title'] ])
@endif

@endsection



		