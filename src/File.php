<?php
	
namespace IAtelier\Atelier;

use Illuminate\Support\Facades\Storage;

trait File {
	
	public function retrive_files_list() {
		if ($this->exists())
		{
			$uri = static::$storageName . '/' . $this->loc;
			return Storage::disk($this->disk)->files($uri);
		}
	}
	public function exists() {
		return isset($this->loc);
	}
}