<?php
	
namespace LILPLP\IBA\Production;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use LILPLP\IBA;
use LILPLP\IBA\Timestamp;

trait BookProduceDimensions {
	
    public function storeDimensions($values)
	{
		foreach (static::$dimensions as $dimension)
		{
			$method = 'store' . studly_case($dimension);
// 			if (array_key_exists($dimension, $values))
			if (!empty($values[$dimension]))
			{
				$this->$method($values);
			}
		}
	}
	
	// Storing Basic Values
	public function storeTitle($values)
	{
		$this->title()->create([ 'value' => $values['title'] ]);
	}
	
	public function storeDescription($values)
	{
		$this->description()->create([ 'value' => $values['description'] ]);
	}
	
	public function storeSubtitle($values)
	{
		$this->subtitle()->create([ 'value' => $values['subtitle'] ]);
	}
	
	public function storeSlug($values)
	{
		if ( $values['slug'] == '' )
		{
			$values['slug'] = str_slug($values['title']);
		}
		$this->slug()->create([ 'value' => $values['slug'] ]);
	}
	
	public function storeThumbnail($values)
	{	
		if ( !empty($values['thumbnail']['name']) )
		{
			$thumbnail['path'] = ( !empty($values['thumbnail']['path']) ) ? $values['thumbnail']['path'] : null;
			$thumbnail['name'] = ( !empty($values['thumbnail']['name']) ) ? $values['thumbnail']['name'] : null;
			$thumbnail['photographer'] = ( !empty($values['thumbnail']['photographer']) ) ? $values['thumbnail']['photographer'] : null;
			$thumbnail['link'] = ( !empty($values['thumbnail']['link']) ) ? $values['thumbnail']['link'] : null;
			
			$this->thumbnail()->create([ 
					'name' => $thumbnail['name'],
					'path' => $thumbnail['path'],
					'photographer' => $thumbnail['photographer'],
					'link' => $thumbnail['link']
				]);
		}
	}
	
	public function storeTimestamp($values)
	{
		if ( $values['timestamp'] ) {
			$timestamp = new Timestamp;
			$timestamp->draft = ( !empty($values['timestamp']['draft']) ) ? Carbon::parse($values['timestamp']['draft']) : null;
			$timestamp->publish = ( !empty($values['timestamp']['publish']) ) ? Carbon::parse($values['timestamp']['publish']) : null;
			$timestamp->amend = ( !empty($values['timestamp']['amend']) ) ? Carbon::parse($values['timestamp']['amend']) : null;
			$this->timestamp()->save($timestamp);
		}
	}
	
	// Store or Update Methods
	public function reviseDimensions($values)
	{
		foreach (static::$dimensions as $dimension)
		{
			$method = 'storeOrUpdate' . studly_case($dimension);
			if (array_key_exists($dimension, $values))
			{
				$this->$method($values);
			}
		}
	}
	
	public function storeOrUpdateTitle($values)
	{
		$title = $this->title;
		$title->value = $values['title'];
		$title->save();
	}
	
	public function storeOrUpdateSlug($values)
	{
		if ( $values['slug'] == '' )
		{
			$values['slug'] = str_slug($values['title']);
		}
		$slug = $this->slug;
		$slug->value = $values['slug'];
		$slug->save();
	}
	
	public function storeOrUpdateDescription($values)
	{
		if ($values['description'] != '')
		{
			if ( $this->description )
			{
				$description = $this->description;
				$description->value = $values['description'];
				$description->save();
			}
			else
			{
				$this->storeDescription($values);
			}
		}
		elseif ( $this->description )
		{
			$this->description()->delete();
		}
		
	}
	
	public function storeOrUpdateSubtitle($values)
	{
		if ($values['subtitle'] != '')
		{
			if ( $this->subtitle )
			{
				$subtitle = $this->subtitle;
				$subtitle->value = $values['subtitle'];
				$subtitle->save();
			}
			else
			{
				$this->storeSubtitle($values);
			}
		}
		elseif ( $this->subtitle )
		{
			$this->subtitle()->delete();
		}
	}
	
	public function storeOrUpdateThumbnail($values)
	{
		if ($values['thumbnail']['name'] != '')
		{
			if ( $this->thumbnail )
			{
				$this->thumbnail->path = ( !empty($values['thumbnail']['path']) ) ? $values['thumbnail']['path'] : null;
				$this->thumbnail->name = ( !empty($values['thumbnail']['name']) ) ? $values['thumbnail']['name'] : null;
				$this->thumbnail->photographer = ( !empty($values['thumbnail']['photographer']) ) ? $values['thumbnail']['photographer'] : null;
				$this->thumbnail->link = ( !empty($values['thumbnail']['link']) ) ? $values['thumbnail']['link'] : null;
				$this->thumbnail->save();
			}
			else
			{
				$this->storeThumbnail($values);
			}
		}
		elseif ( $this->thumbnail )
		{
			$this->thumbnail()->delete();
		}
	}
		
	public function storeOrUpdateTimestamp($values)
	{
		if ( $this->timestamp )
		{
			$this->timestamp->draft = ( !empty($values['timestamp']['draft']) ) ? Carbon::parse($values['timestamp']['draft']) : null;
			$this->timestamp->publish = ( !empty($values['timestamp']['publish']) ) ? Carbon::parse($values['timestamp']['publish']) : null;
			$this->timestamp->amend = ( !empty($values['timestamp']['amend']) ) ? Carbon::parse($values['timestamp']['amend']) : null;
			$this->timestamp->save();
		}
		else
		{
			$this->storeTimestamp($values);
		}
	}
	
}