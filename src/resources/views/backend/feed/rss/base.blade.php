<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:dc="http://purl.org/dc/elements/1.1/">

<channel>
	<title>@stack('title')</title>
	<link>@stack('link')</link>
	<description><![CDATA[@stack('description')]]></description>
	<atom:link href="@stack('linkSelf')" rel="self" type="application/rss+xml" />
	@yield('feed')
	
</channel>
</rss>