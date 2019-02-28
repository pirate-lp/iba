<?php

namespace IAtelier\Atelier;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $fillable = ['value'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function descriptionable()
    {
        return $this->morphTo();
    }
}
