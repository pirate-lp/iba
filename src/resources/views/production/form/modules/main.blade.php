<div class="panel-edit">
	
	<div class="form-box">
	<div class="os-form-group">
		@if (in_array('title', $book->dimensions))
			<label class="label">Title: </label>
			<input class="form-control" name="title" type="text" class="pure-input-1 form-control" placeholder="Title" value="{{ $book->title->value or ''}}">
		@endif
	</div>
			
	<div class="os-form-group">
		@if (in_array('subtitle', $book->dimensions))
			<label class="label">Subtitle: </label>
			<input class="form-control" name="subtitle" type="text" class="pure-input-1 form-control" placeholder="Subtitle" value="{{ $book->subtitle->value or ''}}">
		@endif
	</div>
			
	<div class="os-form-group">
		@if (in_array('slug', $book->dimensions))
			<label class="label">Slug</label>
			<input class="form-control" name="slug" type="text" class="pure-input-1 form-control" placeholder="Slug" value="{{ $book->slug->value or ''}}">
		@endif
	</div>
			
	<div class="os-form-group">
		@if (in_array('description', $book->dimensions))
			<label class="label">Description: </label>
			<textarea name="description" class="pure-input-1 form-control" type="text" placeholder="Description">{{ $book->description->value or '' }}</textarea>
		@endif
	</div>
	</div>
	<div class="form-box">	
	<details>
		<summary>Text</summary>
		<textarea name="content" class="text-editor pure-input-1 form-control" type="text" placeholder="Content of the book ..." >@if (method_exists($book, 'content')){!! $book->content_raw !!}@endif</textarea>
	</details>
		</div>
	
</div>