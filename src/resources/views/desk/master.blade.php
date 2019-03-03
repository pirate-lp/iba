@extends('atelier::master')

@section('body')

	<div id="os">
		<div class="menu-bar">
			<a href="#"><b>iAtelier</b></a>
			<a href="/atelier/analog/"><b>{{ config('app.name') }}</b></a>
		</div>
		<div class="desk">
			@yield('window')
		</div>
		
	</div>

@endsection