@extends('iba::master')

@section('body')

<header><h4>Web Content Distributor<br /><small>Version 0.0.1</small></h4></header>

<div class="pure-g">
	<div class="cen {{ $ideaStandard }}">

		@yield('main')
	</div>
</div>



@endsection
