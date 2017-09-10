<?php

namespace LILPLP\IBA;

use Illuminate\Database\Eloquent\Model;
use LILPLP\IBA\People;

class Name extends Model
{
    //
    protected $fillable = ['identifier','firstname', 'lastname', 'middlename'];
    
    public function people()
    {
	    return $this->belongsTo(People::class);
    }
}
