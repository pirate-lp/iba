@extends('iba::bundle.base')

@section('form')

	<form class="pure-form pure-form-stacked" action="/iba/analog/bundle/{{ $book->id }}/" method="post">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		<h2>Editing Bundle</h2>
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
		
		<button type="submit" class="pure-button pure-button-primary">Update</button>
	</form>

@endsection