@extends('iba::bundle.base')

@section('form')

<!--
<article class="shadw">
<h2>New Bundle</h2>

<form class="pure-form pure-form-stacked" action="/iba/analog/bundle/" method="post">
{{ csrf_field() }}
<div class="pure-g">

	<fieldset class="pure-group pure-u-1 pure-u-md-5-8">
		<legend>Main parts</legend>
		<input name="title" type="text" class="pure-input-3-4" placeholder="A title">
		<input name="subtitle" type="text" class="pure-input-3-4" placeholder="Subtitle">
		<input name="slug" class="pure-input-3-4" type="text" placeholder="a-slug">
		<input name="description" class="pure-input-3-4" type="text" placeholder="Description">
		<input name="type" class="pure-input-3-4" type="text" placeholder="Type">
	</fieldset>
</div>
	<button type="submit" class="pure-button pure-input-1-2 pure-button-primary">Create</button>
</form>
</article>
-->

	<form class="pure-form pure-form-stacked" action="/iba/analog/bundle/" method="post">
	{{ csrf_field() }}
		<h2>Creating Bundle</h2>
		<div class="c-card">
			<div class="c-card__item c-card__item--divider">Type</div>
			
			<div class="c-card__item">
				<input name="type" class="pure-input-3-4" type="text" placeholder="Type" value="{{ $book->type or '' }}">
			</div>
			
			<div class="c-card__item">	
					<fieldset class="pure-group">
						<input name="title" type="text" class="pure-input-3-4" placeholder="A title" value="{{ $book->title->value or '' }}">
						<input name="subtitle" type="text" class="pure-input-3-4" placeholder="Subtitle" value="{{ $book->subtitle->value or '' }}">
						<input name="slug" class="pure-input-3-4" type="text" placeholder="a-slug" value="{{ $book->slug->value or '' }}">
						<textarea  name="description" class="pure-input-3-4" type="text" placeholder="Description" value="{{ $book->description->value or '' }}"></textarea>
					</fieldset>
			</div>
		</div>
		
		<button type="submit" class="pure-button pure-button-primary">Create</button>
	</form>

@endsection