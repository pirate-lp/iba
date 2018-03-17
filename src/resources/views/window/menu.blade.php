<?php $bookTypes = config('iba.book_types'); ?>
<nav class="atelier-admin-menu">
	<ul>
		@foreach ( $bookTypes as $bookType )
			<li>
				<a  class="icon" href="{{ url('/iba/analog/' . $bookType . '/create') }}"><span class="icon icon-list-add"></span>
</a>
				<a class="text" href="{{  url('/iba/analog/' . $bookType ) }}">{{ title_case($bookType) }}</a>
			</li>
		@endforeach
			<li>
				<a class="icon" href="{{ url('/iba/analog/bundle/create') }}"><span class="icon icon-list-add"></span>
</a>
				<a class="text" href="{{  url('/iba/analog/bundle' ) }}">Bundle</a>
			</li>
<!--
		<li><a href="{{ url('/login') }}">Login</a></li>
		<li><a href="{{ url('/register') }}">Register</a></li>
-->
	</ul>
</nav>