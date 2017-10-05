<?php $bookTypes = config('iba.book_types'); ?>
<div class="aside-main-menu">
	<ul class="c-nav u-high">
	
		@foreach ( $bookTypes as $bookType )
			<li class="c-nav__item">
				<a href="{{ url('/iba/analog/' . $bookType . '/create') }}"><i class="fa fa-plus" aria-hidden="true"></i>
</a>
				<a href="{{  url('/iba/analog/' . $bookType ) }}">{{ title_case($bookType) }}</a>
			</li>
		@endforeach
	
		<li class="c-nav__item">
				<a href="{{ url('/iba/analog/bundle/create') }}"><i class="fa fa-plus" aria-hidden="true"></i>
</a>
				<a href="{{  url('/iba/analog/bundle' ) }}">Bundle</a>
			</li>
			
<!--
		<li><a href="{{ url('/login') }}">Login</a></li>
		<li><a href="{{ url('/register') }}">Register</a></li>
-->
	</ul>
</div>