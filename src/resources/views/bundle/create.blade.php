@extends('atelier::production.create')

@push('extra-components')
	<div class="form-box">
		<div class="c-card__item c-card__item--divider">Type</div>			
		<div class="c-card__item">
			<input name="type" class="pure-input-3-4" type="text" placeholder="Type" value="{{ $book->type ?? '' }}">
		</div>
	</div>
@endpush