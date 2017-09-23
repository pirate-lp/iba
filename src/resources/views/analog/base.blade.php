@extends('iba::analog.master')

@section('body')

<div class="pure-g">
	<div class="pure-u-1 pure-u-sm-1-1 pure-u-md-4-5 pure-u-lg-6-7 pure-u-xl-7-8">
		@yield('main')
	</div>
	<div class="pure-u-1 pure-u-sm-1-1 pure-u-md-1-5 pure-u-lg-1-7 pure-u-xl-1-8">
		@include('iba::analog.modules.base.menu', ['title' => ''])
	</div>
</div>

@endsection
