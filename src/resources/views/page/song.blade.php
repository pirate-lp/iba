@extends('page')

@section('main')

<div class="pure-g">
		<div class="cen pure-u-1 pure-u-sm-23-24 pure-u-md-17-24 pure-u-lg-15-24 pure-u-xl-13-24">
			<article class="shadow text">

			{!! $page['content'] !!}
	
				</article>
		</div>
	</div>
@endsection