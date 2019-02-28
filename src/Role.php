<?php

namespace IAtelier\Atelier;

use Illuminate\Database\Eloquent\Model;
use IAtelier\Atelier\People;

class Role extends Model
{
    //
    protected $fillable = ['role'];
	protected $table = 'peopleables';
    
    public function roleable()
    {
        return $this->morphTo('peopleable');
    }
    
    public function people()
    {
	    return $this->belongsTo(People::class);
    }
}
