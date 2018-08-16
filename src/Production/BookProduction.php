<?php
	
namespace PirateLP\IBA\Production;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;
use ParsedownExtra;

use PirateLP\IBA;

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
	
	public function revise($values)
	{
		$this->reviseDimensions($values);
		$this->reviseGroupings($values);
		$this->reviseContent($values);
		$this->save();
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