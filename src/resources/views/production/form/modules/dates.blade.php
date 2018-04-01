<header>Dates</header>
<div class="c-card__item pure-control-group">
	<div class="os-form-group">
		<label>Draft: </label>
		<input class="flatpickr form-control" name="timestamp[draft]" type="text" @if ( isset($book->timestamp->draft) )
				value="{{ $book->timestamp->draft->toDateString() }}"
			@endif
			>
	</div>
	<div class="os-form-group">
		<label>Publish: </label>
		<input class="flatpickr form-control" name="timestamp[publish]" type="text" @if (isset($book->timestamp->publish) )
			value="{{ $book->timestamp->publish->toDateString() }}"
		@endif
		>
	</div>
	<div class="os-form-group">
		<label>Amend: </label>
		<input class="flatpickr form-control" name="timestamp[amend]" type="text" @if ( isset($book->timestamp->amend) )
				value="{{ $book->timestamp->amend->toDateString() }}"
			@endif
			>
	</div>
</div>