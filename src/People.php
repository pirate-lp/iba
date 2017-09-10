<?php

namespace LILPLP\IBA;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    //
    protected $table = 'peoples';
    public function detail()
    {
        return $this->hasOne(Name::class);
    }
    public function slug()
    {
        return $this->morphOne(Slug::class, 'slugable');
    }
    public function description()
    {
        return $this->morphOne(Description::class, 'descriptionable');
    }
    public function thumbnail()
    {
        return $this->morphOne(Thumbnail::class, 'thumbnailable');
    }
    
    public function roles()
    {
	    return $this->hasMany(Role::class, 'people_id', 'id');
    }
    
    public function getNameAttribute($value)
    {
	    if ( $value == null )
	    {
		    return $this->detail->identifier;
	    } else {
		    return $value;
	    }
    }
}
