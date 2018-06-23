<?php

namespace LILPLP\IBA;

use LILPLP\IBA\Book as Book;

class Bundle extends Book
{
    public $fillable = ['type'];
    public $class = Bundle::class;
     
    public static $dimensions = ['title', 'subtitle', 'description', 'slug', 'thumbnail'];
    public static $groupings = [];
    public static $storageName = [];
    
    protected $with = ['title', 'subtitle', 'slug'];
    
    public function items($item_type)
    {
	    return $this->morphedByMany($item_type, 'bundleable', 'bundleable_id');
    }

}
