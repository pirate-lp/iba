@include('iba::production.form.modules.main')
		
	<div class="grid-large panel-edit">
	
		<div class="form-box">
			@include('iba::production.form.modules.thumbnail')
		</div>
		
		
		<div class="form-box">
			@include('iba::production.form.modules.people')
		</div>
			
		
		<div class="form-box">
			@include('iba::production.form.modules.dates')
		</div>
			
		<div class="form-box">
			@include('iba::production.form.modules.keywords')
		</div>
	
		<div class="form-box">
			<div class="c-card__item c-card__item--divider">Bundles</div>
			@if ( isset($bundles) )
	   			@foreach ( $bundles as $key => $values )
					<div class="c-card__item">
						<div class="os-form-group">
							<label>{{ $key }}: </label>
							<select name="bundles[]" class="form-control">
								<option value=''></option>
								@foreach ( $values as $value )
									<option value="{{ $value->toJson() }}">
										{{ $value->title->value }}
									</option>
								@endforeach
							</select>
						</div>
					</div>
				@endforeach
			@endif
		</div>
	</div>
</div>