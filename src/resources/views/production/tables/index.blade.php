<article class="shadow" style="overflow: visible;">
	<table class="pure-table">
		<thead>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th>Date</th>
			</tr>
		</thead>
	
		<tbody>
			@foreach ( $items as $item )
			<tr>
				<td>{{ $item->id }}</td>
				<td><a href="/backend/{{ $type }}s/{{ $item->id }}/edit/">{{ $item->title->value }}</a></td>
				<td>{{ $item->timestamp->publish or '' }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</article>