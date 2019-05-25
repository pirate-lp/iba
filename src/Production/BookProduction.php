<?php
	
namespace IAtelier\Atelier\Production;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;
use ParsedownExtra;


use Illuminate\Http\Request;

use IAtelier\Atelier;

trait BookProduction {
	
	use BookProduceDimensions;
	use BookProduceGroupings;
	
    public function store($values)
	{
		$this->storeDimensions($values);
		$this->storeGroupings($values);
		$this->writeContent($values);
		
	}
	
	public function writeContent($values)
	{
		if ( !empty(static::$storageName) )
		{
			$fileUri = static::$storageName . '/' . $this->id . '/main.md';
			Storage::disk('ibook')->put($fileUri, $values['content']);
			$this->loc = $this->id;
			$this->save();
		}
	}
	
	public function revise($values, $file = null)
	{
		$this->reviseDimensions($values);
		$this->reviseGroupings($values);
		$this->reviseContent($values);
		$this->reviseFile($file);
		$this->save();
	}
	
	public function reviseFile($file) {
		$uri = static::$storageName . '/' . $this->id;
		Storage::disk('ibook')->putFileAs($uri, $file, $file->getClientOriginalName());
	}
	
	public function reviseContent($values)
	{
		if ( !empty(static::$storageName) )
		{
			$fileUri = static::$storageName . '/' . $this->id . '/main.md';
			Storage::disk('ibook')->put($fileUri, $values['content']);
			$this->loc = $this->id;
			$this->save();
		}
	}

}