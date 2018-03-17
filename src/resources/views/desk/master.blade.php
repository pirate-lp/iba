@extends('iba::master')

@section('body')

	<div id="os">
		<div class="menu-bar">
			<a href="#"><b>IBA</b></a>
			<a href="/iba/analog/"><b>{{ config('app.name') }}</b></a>
		</div>
		<div class="desk">
			@yield('window')
		</div>
		
	</div>

@endsection