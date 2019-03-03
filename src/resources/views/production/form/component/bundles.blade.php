<div class="c-card__item c-card__item--divider">Bundles</div>
	@if ( isset($bundles) )
		@foreach ( $bundles as $key => $values )
			<div class="c-card__item">
				<div class="os-form-group">
					<label>{{ $key }}: </label>
					<select name="bundles[]" class="form-control">
						
						<option value=''></option>
						
						@foreach ( $values as $value )
							<option value="{{ $value->toJson() }}"
								@if ( $book->bundleSingle($key) && ($book->bundleSingle($key)->title->value == $value->title->value) )
									selected
								@endif
								>
								{{ $value->title->value }}
							</option>
						@endforeach
						
					</select>
				</div>
			</div>
		@endforeach
	@endif
</div>