<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
     <title>@stack('title')</title> 
     <subtitle>@stack('description')</subtitle>
     <link href="@stack('linkSelf')" rel="self"/> 
     <updated><?php echo date("c", strtotime("2014-03-10 05:40:00")); ?></updated>
     <author> 
          <name>Lost Ideas Lab</name>
          <email>info@lostideaslab.com</email>
     </author>
     <id>http://lostideaslab.com/</id>
     @yield('feed')
</feed>