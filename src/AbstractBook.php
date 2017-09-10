<?php

Namespace LILPLP\IBA;

class AbstractBook {
	
	public $dimensions = [];
	public $groupings = [];
	public $storageName;
	
	public function __construct($dimensions, $groupings = null, $storageName = null)
	{
		$this->dimensions = $dimensions;
		$this->groupings = $groupings;
		$this->storageName = $storageName;
	}
}