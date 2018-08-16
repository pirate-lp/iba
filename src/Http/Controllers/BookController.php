<?php

namespace PirateLP\IBA\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

use App;

use PirateLP\IBA\AbstractBook;
use PirateLP\IBA\Bundle as Bundle;

class BookController extends Controller
{
	
    public $type;
    public $class;
    public $roles = [];
    public $bundleTypes = [];
    
    public function __construct()
    {
/*
	    $this->class = 'App\\' . studly_case($this->type);
	    if ($this->type == "bundle")
	    {
		    $this->class = "PirateLP\\IBA\\Bundle";
	    }
*/
    }
    
    public function dashboard()
    {
	    $r['count'] = $this->class::count();
		$r['name'] = $this->type;
		$r['size'] = $this->get_dir_size();
		return $r;
    }
    
    private function get_dir_size()
    {
	    $dir_size = 0;
		$dir = storage_path() . "/ibook/" . $this->class::$storageName . "/";
		if ( !is_dir($dir) )
		{
			return "no directory";
		}
		foreach( File::allFiles($dir) as $file)
		{
			$dir_size += $file->getSize();
		}
		return number_format($dir_size / 1048576,2);
    }
    
    public function manage()
	{
		$abstract = new AbstractBook($this->class::$dimensions, $this->class::$groupings);
		$items = $this->class::with($this->class::$dimensions)->get();
		if ( in_array('web', Route::current()->computedMiddleware) ) {
			$type = $this->type;
			return view('iba::manage', compact('items', 'type'));
		} else {
			return response()->json(compact('items', 'abstract'));
		}
	}
	
	public function create()
    {
	    $book = new AbstractBook($this->class::$dimensions, $this->class::$groupings);
	    
	    foreach ( $this->bundleTypes as $bundle )
	    {
		    $bundles[$bundle] = Bundle::with($this->class::$dimensions)->where('type', $bundle)->get();
// 			$bundles[$bundle] = App\Bundle::where('type', $bundle)->get();
	    }
	    $roles = $this->roles;
	    $type = $this->type;
	    if ( in_array('web', Route::current()->computedMiddleware) ) {
			$type = $this->type;
			return view('iba::create', compact('book', 'bundles', 'type', 'roles'));
		} else {
			return response()->json(compact('book', 'bundles', 'roles'));
		}
    }
	    
    public function edit($id)
    {
	    foreach ( $this->bundleTypes as $bundle )
	    {
		    $bundles[$bundle] = Bundle::with('title')->where('type', $bundle)->get();
	    }
	    
	    $type = $this->type;
	    $roles = $this->roles;
	    
	    $abstractBook = new AbstractBook($this->class::$dimensions, $this->class::$groupings);
		
		$currentBook = $this->class::with($this->class::$dimensions)->find($id);
		
		$people = null;
		if ( in_array('people', $this->class::$groupings) )
		{
			foreach( $this->roles as $role )
			{
				$people[$role] = $currentBook->peoples($role)->get();
			}
		}
		
		$booksBundles = null;
		if ( in_array('bundles', $this->class::$groupings) )
		{
			foreach( $this->bundleTypes as $bund)
			{
				if ($currentBook->bundleSingle($bund) != null ) {
					$booksBundles[$bund] = $currentBook->bundle($bund)->with('title')->first();
				} else {
					$booksBundles[$bund] = null;
				}
			}
		}
		
		$keywords = null;
		if ( in_array('keywords', $this->class::$groupings) )
		{
			$keywords = $currentBook->keywords()->get();

		}
		
// 	    $book= (object) array_merge((array) $abstractBook, (array) $currentBook->toArray());
		$book = $currentBook;
		$book->dimensions = $abstractBook->dimensions;
		$book->groupings = $abstractBook->groupings;
	    $book->people = $people;
	    $book->keywords = $keywords;
	    $book->bundles = $booksBundles;
	    
	    if ( in_array('web', Route::current()->computedMiddleware) ) {
			$type = $this->type;
			return view('iba::edit', compact('article', 'bundles', 'book', 'type', 'roles'));
		} else {
			$book= (object) array_merge((array) $abstractBook, (array) $book->toArray());
			return response()->json(compact('book', 'bundles', 'roles'));
		}
    }
    
}