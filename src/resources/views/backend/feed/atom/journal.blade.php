@extends('iba::backend.feed.atom.base')

@push('linkSelf')http://lostideaslab.com/journal/feed/atom/@endpush

@push('title')
The Lost Ideas Lab Journal
@endpush

@push('link')http://lostideaslab.com/journal/@endpush

@push('description')
Some places are lost, because those who arrived there never came back. Welcome to The Lost Ideas Lab Journal, if you enter it you may not remain the same person ...
@endpush

@section('feed')

@foreach ( $pages as $page )

	<entry>
		<title><?php echo str_replace(array('&', '<'), array('&#x26;', '&#x3C;'), $page->title->value) ?></title>
		<?php $issue = $page->issue->first(); ?>
		<summary type="html">
			<![CDATA[
				@if (isset($page->thumbnail->name))
					<img src="http://lostideaslab.com/journal/{{ $issue->slug->value }}/{{ $page->slug->value }}/{{ $page->thumbnail->name }}" />
				@endif
				{!! $page->description->value !!} ]]>
		</summary>
		<id>tag:lostideaslab.com,{{ $page->timestamp->publish->toDateString() }}:journal-{{ $page->id or '' }}</id>
		<link href="http://lostideaslab.com/journal/{{ $issue->slug->value or '' }}/{{ $page->slug->value or '' }}/" />
		@if (isset($page->timestamp->publish))
			<updated>{{ $page->timestamp->publish->toRfc3339String() }}</updated>
		@endif
		@foreach ( $page->keywords as $keyword )
			<category term="{{ $keyword->word }}" />
		@endforeach
	</entry>
@endforeach
	
@endsection