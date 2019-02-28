<?php $bookTypes = config('atelier.book_types'); ?>
<nav class="atelier-admin-menu">
	<ul>
		@foreach ( $bookTypes as $bookType )
			<li>
				<a  class="icon" href="{{ url('/atelier/analog/' . $bookType . '/create') }}"><span class="icon icon-list-add"></span>
</a>
				<a class="text" href="{{  url('/atelier/analog/' . $bookType ) }}">{{ title_case($bookType) }}</a>
			</li>
		@endforeach
			<li>
				<a class="icon" href="{{ url('/atelier/analog/bundle/create') }}"><span class="icon icon-list-add"></span>
</a>
				<a class="text" href="{{  url('/atelier/analog/bundle' ) }}">Bundle</a>
			</li>
<!--
		<li><a href="{{ url('/login') }}">Login</a></li>
		<li><a href="{{ url('/register') }}">Register</a></li>
-->
	</ul>
</nav>