<div class="panel-edit">
	<div class="form-box">
		<h4>File Management<sup>*</sup></h4>
		<div class="os-form-group">
			@isset( $book->files )
				<ul>
					@foreach ( $book->files as $file)
					<li>{{ $file }}</li>
					@endforeach
				</ul>
			@endisset
		</div>
		<div>
			<input type="file" name="uploaded_file" id="file">
			<input type="submit" value="Upload Image" name="submit">
		</div>
		<footer>
			<p>*: currently under development. Only uploading file works.</p>
		</footer>
	</div>
	
</div>