<?php

namespace IAtelier\Atelier;

use Illuminate\Database\Eloquent\Model;
use IAtelier\Atelier\People;

class Name extends Model
{
    //
    protected $fillable = ['identifier','firstname', 'lastname', 'middlename'];
    
    public function people()
    {
	    return $this->belongsTo(People::class);
    }
}
