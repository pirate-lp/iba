<?php
	
namespace IAtelier\Atelier\Production;

use Illuminate\Database\Eloquent\Model;
use IAtelier\Atelier\Keyword;
use IAtelier\Atelier\Role;
use IAtelier\Atelier\People;
use IAtelier\Atelier\Name;
use App;

use Illuminate\Support\Collection;

trait BookProduceGroupings {
	
    public function storeGroupings($values)
	{
		foreach (static::$groupings as $grouping)
		{
			$method = 'store' . studly_case($grouping);
			if (array_key_exists($grouping, $values))
			{
				$this->$method($values);
			}
		}
	}	
	// Complex Store Methods
	
	public function storeKeywords($values)
	{
		if ( $values['keywords'] != '' )
		{
			$this->syncKeywords($values['keywords']);
		}
	}

	public function storePeople($values)
	{
		if ( array_key_exists('people', $values) )
		{
			foreach ( $values['people'] as $role => $people )
			{
				$people = $this->convert($people);
				if ( !empty($people) )
				{{}
					foreach ( $people as $person )
					{
						if ( isset($person['id']) && is_numeric($person['id']) && People::find($person['id']) )
						{
							$person = People::find($person['id']);
						} else {
							$key = Name::where('identifier', $person['name'] )->first();
							if ( !is_null($key) )
						    {
							    $person = $key->people()->first();
						    }
						    else
						    {
							    $newPerson = new People;
							    $newPerson->save();
								$newPerson->detail()->create([ 'identifier' => $person['name'] ]);
								$person = $newPerson;
						    }
						}
						$this->people()->attach($person->id, ['role' => $role]);
					}
				}
			}
		}
	}
	
	
	
	public function storeBundles($values)
	{
		echo( gettype($values['bundles']) );
		foreach ( $values['bundles'] as $bundle )
		{
			$bundle = $this->convert($bundle);
			$this->bundles()->attach($bundle['id']);
		}
	}
	
	// generic functions
	
	private function attachPeoples($idValues, $role)
	{
		if ($idValues != '') {
			$idValues = explode(',',$idValues);
			$idValues = collect($idValues);
			
			$values = $idValues->filter(function ($value, $key) {
			    return !is_numeric($value);
			});
			$new_keywords_ids = newPeoples($values);
			
			
			$ids = $idValues->filter(function ($value, $key) {
			    return is_numeric($value);
			});
			
			$all_ids = array_merge($new_keywords_ids, $ids->toArray());
			foreach ( $all_ids as $id )
			{
				$toSync[$id]['role'] = $role;
			}
			$this->people()->attach($toSync);
		}
	}
	
	public function syncKeywords($keywords)
	{
		$newsKeywords = [];
		$keywords = $this->convert($keywords);
		foreach ($keywords as $keyword)
		{
			if (isset($keyword['id']) && is_numeric($keyword['id']) && Keyword::find($keyword['id']) )
			{
				$keyword = Keyword::find($keyword['id']);
			} else {
				$newkeyword = new Keyword;
				$key = $newkeyword->where('word', $keyword['word'])->first();
				if ( !is_null($key) )
			    {
				    $keyword = $key;
			    }
			    else
			    {
				    $newkeyword->word = $keyword['word'];
				    $newkeyword->save();
				    $keyword = $newkeyword;
			    }
			}
			$newsKeywords[] = $keyword->id;
		}
		$this->keywords()->sync($newsKeywords);

	}

	
	
	// Store or Update Methods
	public function reviseGroupings($values)
	{
		foreach (static::$groupings as $grouping)
		{
			$method = 'storeOrUpdate' . studly_case($grouping);
			if (array_key_exists($grouping, $values))
			{
				$this->$method($values);
			}
		}
	}
	
	public function storeOrUpdateKeywords($values)
	{
		$this->syncKeywords($values['keywords']);
	}
	
	public function storeOrUpdateBundles($values)
	{
		$bundles = array();
		foreach($values['bundles'] as $type => $bundle)
		{
			$bundle = $this->convert($bundle);
			if (isset($bundle['id']))
			{
				$bundles[] = $bundle['id'];
			}
		}
		if (count($bundles) == 1)
		{
			$this->bundles()->sync($bundles[0]);
		}
		else {
			$this->bundles()->sync($bundles);
		}
		
		
	}
	
	public function storeOrUpdatePeople($values)
	{
		$pp = $this->people()->get();
		$newRelationships = [];
		$existingRelationships = [];
		foreach ($pp as $personsRole)
		{
			$existingRelationships[] = $personsRole->pivot->id;
		}

		$collections = $values['people'];
		foreach( $collections as $role => $collection )
		{
			$collections[$role] = $this->convert($collection);
		}
		
		$newPeople = array();
		foreach( $collections as $role => $collection )
		{
			foreach ( $collection as $key => $person )
			{
				if ( !array_key_exists('id', $person) || !is_numeric($person['id']))
				{
					$newPeople[] = $person['name'];
					
					$people = new People;
				    $name = Name::where('identifier', $person['name'])->first();
				    if ( !is_null($name) )
				    {
					    $collections[$role][$key]['id'] = $name->people->id;
				    }
				    else
				    {
					    $people->save();
					    $people->detail()->create([ 'identifier' => $person['name']]);
					    $collections[$role][$key]['id'] = $people->id;
				    }
// 					$collections[$role][$key]['id'] = $id;
				}
			}
		}
		
		
// 		dd($people);

/*
		 = $people->filter(function($value, $key){
			 { return $value; }
		});
*/
// 		dd($newPeople);
		
// 		$newPoepleIds = newPeoples($newPeople);
// 		dd($newPoepleIds);
// 		$syncs = array();
		
/*
		foreach( $existingPeople as $personRoleRelation )
		{
			if ( in_array($personRoleRelation['people_id'] )
		}
*/
		
		foreach( $collections as $role => $collection )
		{
			$collection = $this->convert($collection);
			foreach ( $collection as $person )
			{
				$ifExisting = $this->people()->where('role',$role)->where('people_id', $person['id'])->first();
				if ( $ifExisting )
				{
					// this relationship already exists
					$newRelationships[] = $ifExisting->pivot->id;
				}
				else
				{
					$this->people()->attach($person['id'], ['role' => $role]);
					$newRelationships[] = $this->people()->where('role',$role)->where('people_id', $person['id'])->first()->pivot->id;
				}
			}
		}
		
		
/*
		
				else
				{
					$newPerson = People::whereHas('detail', function ($query) use ( $person ) {
					    	$query->where('identifier', $person['name']);
					    })->first();
					$this->people()->attach($person->id, ['role' => $role]);
				}
			}
		}
*/
		
		foreach( $existingRelationships as $ER )
		{
			
				if(!in_array($ER, $newRelationships))
				{
					$relation = Role::find($ER);
					$relation->delete();
				}
			
		}
// 		dd($syncs);
// 		
// 		$this->people()->sync($syncs);


		
/*
		$this->people()->detach();
		foreach ( $values['people'] as $key => $value )
		{
			$this->attachPeoples($value, $key);
		}
*/

	}

	
	public function convert($string) {
		if (is_string($string))
		{
			return json_decode($string, true);
		}
		return $string;
	}
}