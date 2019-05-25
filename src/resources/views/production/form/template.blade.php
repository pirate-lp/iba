@include('atelier::production.form.component.basics')

@include('atelier::production.form.component.file')

<div class="grid-large panel-edit">
	@stack('extra-components')
</div>

<div class="grid-large panel-edit">
	
	<div class="form-box">
		@include('atelier::production.form.component.thumbnail')
	</div>
	
	<div class="form-box">
		@include('atelier::production.form.component.dates')
	</div>
	
	@foreach( $book->groupings as $grouping )
		<div class="form-box">
			@include('atelier::production.form.component.' . $grouping)
		</div>
	@endforeach
</div>