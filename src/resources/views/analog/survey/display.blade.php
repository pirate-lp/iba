@extends('iba::page.base')

@section('content')
<div class="pure-g">
<div class="{{ $mainStandard }}">
	<header>
		<h2>Survey on consumer perception</h2>
		<h3>on how their privacy is respected or disrespected in today's world</h3>
	</header>
	<article class="shadow">
		@foreach ( $items as $item )
		{{ $item }}
		@endforeach
	</article>
	<article class="shadow">
		@foreach ( $responds as $respond )
		{{ $respond }}
		@endforeach
	</article>
</div>
</div>

@endsection