@extends('people.base')

@section('page')

<div class="pure-g">
<section class="{{ $ideaStandard }}">
	<header><h1>Hossein</h1></header>
<div class="pure-g">
	<section class="{{ $ideaSStandard }}">
		<div class="dashboard-gray article">
			<p><img class="feature right" src="/assets/images/people//hossein.jpg" alt="" style="max-width: 100%"/></p>
			<h2>Founder & the man behind Lost Ideas Lab</h2>
			<p>There are two songs that I resonate with them a lot:</p>
			<ul>
                <li>“No Roots” by Amy MacDonald</li>
                <li>“Heart of a Child” by Jennette McCurdy</li>
            </ul>
        </div>
        <div class="dashboard-gray article">
        	<p><a class="inlink" href="https://twitter.com/hossein_lil" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> <a class="inlink" href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a> <a class="inlink" href=""><i class="fa fa-xing" aria-hidden="true"></i></a></p>
        </div> 
	</section>
	<section class="{{ $ideaLStandard }}">
	<section>
	@component('modules.blog.widget', ['categories' => array('diary', 'reflections') ])
		    @slot('title')
		        Intimate Blog Updates
		    @endslot
		@endcomponent
	</section>
	<section>
		<article class="shadow">
			<h2>More about me ...</h2>
		    <p>I wish to be a social entrepreneur the kind of building wonderful places and spaces for creatives of the world, if Allah wills.</p>
		    <p>I also wish to tell stories, write and sing songs and make films among all the other more business-like looking ideas, if Allah wills.</p>
		    <p>I tend to let a reference to someone I love whenever I talk about myself, cause it matters more to me but it looks like, I should wait with all this. There were two women I loved to be with them, but I severely failed loving someone in a relationship two times, maybe one day I met someone who doesn’t share her love with somebody else, if Allah wills.</p>
	    </article>
	</section>
	</section>
	
</div>
</section>
</div>

@endsection