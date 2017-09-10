@extends('iba::backend.feed.rss.base')

@push('linkSelf')http://lostideaslab.com/journal/feed/rss/@endpush

@push('title')
The Lost Ideas Lab Journal
@endpush

@push('link')http://lostideaslab.com/journal/@endpush

@push('description')
Some places are lost, because those who arrived there never came back. Welcome to The Lost Ideas Lab Journal, if you enter it you may not remain the same person ...
@endpush

@section('feed')

@foreach ( $pages as $page )
	<item>
		<title><?php echo str_replace(array('&', '<'), array('&#x26;', '&#x3C;'), $page->title->value) ?></title>
		<?php $issue = $page->issue->first(); ?>
		<description>
			<![CDATA[{!! $page->description->value !!} ]]>
		</description>
		<link>http://lostideaslab.com/journal/{{ $issue->slug->value or '' }}/{{ $page->slug->value or '' }}/</link>
		@if (isset($page->timestamp->publish))
			<pubDate>{{ $page->timestamp->publish->toRfc1123String() }}</pubDate>
		@endif
		@if (isset($page->thumbnail->name))
			<media:content width="460" url="http://lostideaslab.com/journal/{{ $issue->slug->value }}/{{ $page->slug->value }}/{{ $page->thumbnail->name }}">
				<media:credit scheme="urn:ebu">Photograph: {{ $page->thumbnail->photographer or '' }}</media:credit>
			</media:content>
		@endif
		<guid>http://lostideaslab.com/journal/{{ $issue->slug->value or '' }}/{{ $page->slug->value or '' }}/</guid>
		@foreach ( $page->keywords as $keyword )
			<category>{{ $keyword->word }}</category>
		@endforeach
	</item>
@endforeach
	
@endsection