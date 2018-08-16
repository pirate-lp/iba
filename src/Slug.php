<?php

namespace PirateLP\IBA;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    //
    protected $fillable = ['value'];
	protected $hidden = ['created_at', 'updated_at'];
    
    public function slugable()
    {
        return $this->morphTo();
    }
    
    public function getRouteKeyName()
	{
	    return 'value';
	}
}
