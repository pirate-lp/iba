@extends('iba::base')

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
		<article class="shadow">
			<h3>Interactibe Books' Atelier</h3>
			<h4>Tips</h4>
			<h4>News</h4>
		</article>
	</div>
</div>
@endsection