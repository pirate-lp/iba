@extends('iba::desk.master')

@section('window')

	<div class="window">
		
		<div class="bar">
			<div class="menu">
				<div class="window-title">
					@stack('title')
				</div>
			</div>
			<div class="buttons"></div>
			<div class="tabs">
				<a href="">New Tab</a>
<!--
				<router-link to="/outline">Outline</router-link>
				<router-link to="/events">Events</router-link>
				<router-link to="/bundle">Bundle</router-link>
-->
			</div>
		</div>
		
		<div class="content">
			<div class="sidebar">
				@include('iba::window.menu', ['title' => ''])
			</div>
			
			<div class="panel">
				@yield('main')
			</div>
		</div>
		
		<div class="footer">
		</div>
		
	</div>


@endsection
