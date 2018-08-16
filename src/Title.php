<?php

namespace PirateLP\IBA;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    //
    protected $fillable = ['value'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function titleable()
    {
        return $this->morphTo();
    }
}
