@extends('iba::backend.feed.atom.base')

@push('linkSelf')http://lostideaslab.com/blog/feed/atom/@endpush

@push('title')
Lost Ideas Lab Blog
@endpush

@push('link')http://lostideaslab.com/blog/@endpush

@push('description')It is just to have an answer to that question “what are you doing?” ...@endpush


@section('feed')

@foreach ( $pages as $page )
	<entry>
		<title><?php echo str_replace(array('&', '<'), array('&#x26;', '&#x3C;'), $page->title->value) ?></title>
		<link href="http://lostideaslab.com/blog/{{ $page->id or '' }}/" />
		@if (isset($page->timestamp->publish))
			<updated>{{ $page->timestamp->publish->toRfc3339String() }}</updated>
		@endif
		@foreach ( $page->keywords as $keyword )
			<category term="{{ $keyword->word }}" />
		@endforeach
		<id>tag:lostideaslab.com,{{ $page->timestamp->publish->toDateString() }}:blog-{{ $page->id or '' }}</id>
		<content type="html">
			<![CDATA[
				@if (isset($page->thumbnail->name))
					<img src="http://lostideaslab.com/blog/{{ $page->id }}/{{ $page->thumbnail->name }}" />
				@endif
				{!! $page->content() !!} ]]>
		</content>
	</entry>
@endforeach
	
@endsection