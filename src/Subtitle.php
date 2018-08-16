<?php

namespace PirateLP\IBA;

use Illuminate\Database\Eloquent\Model;

class Subtitle extends Model
{
    //
    protected $fillable = ['value'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function subtitleable()
    {
        return $this->morphTo();
    }
}
