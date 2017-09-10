@extends('iba::backend.feed.rss.base')

@push('linkSelf')http://lostideaslab.com/blog/feed/rss/@endpush

@push('title')
Lost Ideas Lab Blog
@endpush

@push('link')http://lostideaslab.com/blog/@endpush

@push('description')It is just to have an answer to that question “what are you doing?” ...@endpush


@section('feed')

@foreach ( $pages as $page )
	<item>
		<title><?php echo str_replace(array('&', '<'), array('&#x26;', '&#x3C;'), $page->title->value) ?></title>
		<description>
			<![CDATA[{!! $page->content() !!} ]]>
		</description>
		<link>http://lostideaslab.com/blog/{{ $page->id or '' }}/</link>
		@if (isset($page->timestamp->publish))
			<pubDate>{{ $page->timestamp->publish->toRfc1123String() }}</pubDate>
		@endif
		@if (isset($page->thumbnail->name))
			<media:content width="460" url="http://lostideaslab.com/blog/{{ $page->id }}/{{ $page->thumbnail->name }}">
				<media:credit scheme="urn:ebu">Photograph: {{ $page->thumbnail->photographer or '' }}</media:credit>
			</media:content>
		@endif
		<guid>http://lostideaslab.com/blog/{{ $page->id or '' }}/</guid>
		@foreach ( $page->keywords as $keyword )
			<category>{{ $keyword->word }}</category>
		@endforeach
	</item>
@endforeach
	
@endsection