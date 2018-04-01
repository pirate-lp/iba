@if ( !isset($thumbnail))
			<div>
				<label class="c-card__item c-card__item--divider" for="accordion-2">Thumbnail</label>
				
				<div class="pure-group c-card__item">
					<input class="form-control" placeholder="location of file" class="form-control" type="text" name="thumbnail[path]" value="{{ $book->thumbnail->path or '' }}">
					<input class="form-control" placeholder="File name" class="form-control" type="text" name="thumbnail[name]" value="{{ $book->thumbnail->name or '' }}">
					<input class="form-control" placeholder="Photographer" class="form-control" type="text" name="thumbnail[photographer]" value="{{ $book->thumbnail->photographer or '' }}">
					<input class="form-control" placeholder="Link to photographer's profile" class="form-control" type="text" name="thumbnail[link]" value="{{ $book->thumbnail->link or '' }}">
				</div>
				
			</div>
		@endif