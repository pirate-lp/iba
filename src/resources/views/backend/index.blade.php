@extends('iba::backend.base')

@section('main')

<div class="pure-g">
	<div class="{{ $ideaStandard }}">
	<div class="pure-g">
	<div class="pure-u-1-1 pure-u-md-1-3">
		<article class="shadow">
			<h3>Manage</h3>
			<ul>
				<li><a href="articles/">Articles</a></li>
				<li><a href="posts/">Posts</a></li>
<!-- 			<li><a href="poems/">Poem</a></li> -->
<!-- 			<li><a href="bundles/">Bundle</a></li> -->
			</ul>
		</article>
	</div>
	<div class="pure-u-1-1 pure-u-md-1-3">
		<article class="shadow">
			<h3>Create</h3>
			<ul>
				<li><a href="articles/create">Article</a></li>
				<li><a href="posts/create">Post</a></li>
				<li><a href="poems/create">Poem</a></li>
				<li><a href="bundles/create">Bundle</a></li>
			</ul>
		</article>
	</div>
	<div class="pure-u-1-1 pure-u-md-1-3">
		<article class="shadow">
			<h3></h3>
			<ul>
				<li><a href="{{ url('/login') }}">Login</a></li>
				<li><a href="{{ url('/register') }}">Register</a></li>
			</ul>
		</article>
	</div>
	</div>
	</div>
</div>

@endsection