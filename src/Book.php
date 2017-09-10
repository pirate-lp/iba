<?php

Namespace LILPLP\IBA;

use Illuminate\Database\Eloquent\Model as Model;

use Carbon\Carbon;

// use App\laravel;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Yaml\Yaml;
use ParsedownExtra;

use LILPLP\IBA\Production\BookProduction;
use LILPLP\IBA\Dimensions;
use LILPLP\IBA\Groupings;
use LILPLP\IBA\Title;
use LILPLP\IBA\SubTitle;

abstract class Book extends Model {
	
	use BookProduction;
	
	protected $fillable = ['loc'];
	
	public static $dimensions = [];
	public static $groupings = [];
	public static $storageName;
	
	public function title()
    {
	    if (in_array('title', static::$dimensions))
	    {
		    return $this->morphOne(Title::class, 'titleable');
	    }
    }
    public function slug()
    {
	    if (in_array('title', static::$dimensions))
	    {
		    return $this->morphOne(Slug::class, 'slugable');
	    }
    }
    public function description()
    {
	    if (in_array('title', static::$dimensions))
	    {
		    return $this->morphOne(Description::class, 'descriptionable');
	    }
    }
    public function subtitle()
    {
	    if (in_array('title', static::$dimensions))
	    {
			return $this->morphOne(Subtitle::class, 'subtitleable');
	    }
    }
    public function thumbnail()
    {
	    if (in_array('title', static::$dimensions))
	    {
			return $this->morphOne(Thumbnail::class, 'thumbnailable');
	    }
    }
    public function timestamp()
    {
	    if (in_array('title', static::$dimensions))
	    {
			return $this->morphOne(Timestamp::class, 'timestampable');
	    }
    }
    /// fix the thing with how to find bundles without issue and sections functions rather something like: getBundle('type'), getBundle('type') alternatively run this in the construction!
    public function bundles()
    {
        return $this->morphToMany(Bundle::class, 'bundleable');
    }
    public function bundle($type)
    {
        return $this->bundles()->where('type', $type);   
    }
    public function bundleSingle($type)
    {
        return $this->bundles()->where('type', $type)->first();   
    }
    
    
    public function keywords()
    {
        return $this->morphToMany(Keyword::class, 'keywordable');
    }
    
    // handle the stuff from Role::dedications and etc ...
    public function people()
    {
        return $this->morphToMany(People::class, 'peopleable')->withPivot('role','id');
    }
    public function peoples($type)
    {
	    return $this->people()->where('role', $type);
    }
    
    
    
    public function content()
	{
		$uri = static::$storageName . '/' . $this->loc . '/main.md';
		$content = Storage::disk('ibook')->get($uri);
		$extra = new ParsedownExtra();
		$HTMLContent = $extra->text($content);
		return $HTMLContent;
	}
    
/*  💛❤️ Further development!
    public function __call($name, $arguments = null)
    {
// 	    dd($arguments);
		
	    if ( in_array($name, static::$dimensions) )
	    {
		    $className = studly_case($name);
		    $tableName = static::$dimensions . 'able';;
		    return $this->morphOne($className, $tableName);
	    }
	    else {
		    return parent::__call($name, $arguments);
	    }
/*
	    elseif ( in_array($name, $this->relations))
	    {
		    
	    }
	}
*/

	public static function withAll()
	{
		$all = array_merge(static::$dimensions, static::$groupings);
		return static::with($all);
	}
/*
	public function withAll()
	{
		$all = array_merge(static::$dimensions, static::$groupings);
		return $this->with($all);
	}
*/

}
	
