<?php

namespace LILPLP\IBA;

use Illuminate\Database\Eloquent\Model;

class Timestamp extends Model
{
    //
    protected $fillable = ['draft', 'publish', 'amend'];
    protected $dates = ['draft', 'publish', 'amend'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function timestampable()
    {
        return $this->morphTo();
    }
}
