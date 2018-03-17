@extends('iba::window.master')

@push('head')
@endpush

@push('title')
Dashboard
@endpush

@section('main')
<div class="pure-g">
	<div class="pure-u-1-1 pure-u-sm-1-1 pure-u-md-1-1 pure-u-lg-1-2">
		<article class="shadow">
			<h3>Books Statistics</h3>
			<table class="pure-table">
				<thead>
					<tr>
						<th>Type</th>
						<th>Size</th>
						<th>Count</th>
					</tr>
				</thead>
			
				<tbody>
					@foreach ( $books as $book )
					<tr>
						<td>{{ $book->name }}</td>
						<td>{{ $book->size }}</a></td>
						<td>{{ $book->count }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</article>
	</div>
	<div class="pure-u-1-1 pure-u-sm-1-1 pure-u-md-1-1 pure-u-lg-1-2">
		<div class="c-card u-heigh">
			<div class="c-card__item c-card__item--divider">Settings</div>
			<div class="c-card__item">
				<p class="c-paragraph">To be developed ...</p>
				<p class="c-paragraph">Control panel</p>
				<p class="c-paragraph">Account</p>
			</div>
		</div>
		<div class="c-card u-heigh">
			<div class="c-card__item c-card__item--divider">Information</div>
			<div class="c-card__item">
				<p class="c-paragraph">You are running</p>
				<p class="c-paragraph">Interactive Books' Atelier, version: 0.8.x</p>
				<p class="c-paragraph">Design & developed by Hossein from scratch at Pirate's Lost Pearl ...</p>
				<p class="c-paragraph">Thanks for choosing Interactive Books' Atelier</p>
			</div>
		</div>
	</div>
</div>
@endsection