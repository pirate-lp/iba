<?php

namespace IAtelier\Atelier\Http\Controllers;

use Illuminate\Http\Request;
use IAtelier\Atelier\Http\Controllers\BookController;

use Illuminate\Support\Facades\Route;

use IAtelier\Atelier\Bundle;
use IAtelier\Atelier\AbstractBook;

class BundleController extends BookController
{
    //
    public $type = 'bundle';
// 	public $roles = ['inspired', 'author', 'dedicated'];
// 	public $bundleTypes = ['selection'];
    public $class = Bundle::class;
    
    
    public function create()
    {
	    $book = new AbstractBook($this->class::$dimensions, $this->class::$groupings);
	    
	    foreach ( $this->bundleTypes as $bundle )
	    {
		    $bundles[$bundle] = Bundle::with($this->class::$dimensions)->where('type', $bundle)->get();
// 			$bundles[$bundle] = App\Bundle::where('type', $bundle)->get();
	    }
	    
	    $bundles = null;
	    foreach ( $this->bundleTypes as $bundle )
	    {
		    $bundles[$bundle] = Bundle::with($this->class::$dimensions)->where('type', $bundle)->get();
	    }
	    
	    $roles = $this->roles;
	    $type = $this->type;
	    if ( in_array('web', Route::current()->computedMiddleware) ) {
			$type = $this->type;
			return view('atelier::bundle.create', compact('book', 'bundles', 'type', 'roles'));
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
		
// 	    $book= (object) array_merge((array) $abstractBook, (array) $currentBook->toArray());
		$book = $currentBook;
		$book->dimensions = $abstractBook->dimensions;
		$book->groupings = $abstractBook->groupings;
	    
	    $bundles = [];
	    foreach ( $this->bundleTypes as $bundle )
	    {
		    $bundles[$bundle] = Bundle::with('title')->where('type', $bundle)->get();
	    }
	    
	    if ( in_array('web', Route::current()->computedMiddleware) ) {
			$type = $this->type;
			return view('atelier::bundle.edit', compact('bundles', 'book', 'type', 'roles'));
		} else {
			$book= (object) array_merge((array) $abstractBook, (array) $book->toArray());
			return response()->json(compact('book', 'bundles', 'roles'));
		}
    }
    
    public function store(Request $request)
    {
	    $this->validate($request, [
	        'title' => 'required',
	        'slug' => 'required'
	    ]);
	    
	    $bundle = new Bundle(['type' => $request->type ]);
		$bundle->save();
		
		$values = $request->only(['title', 'slug', 'subtitle', 'bundles', 'description', 'timestamps']);
 		$bundle->store($values);
 		
		return response()->backend($bundle);
    }
    
    public function update(Request $request, $id)
    {
	    $this->validate($request, [
	        'title' => 'required'
	    ]);
	    $values = $request->only(['title', 'slug', 'subtitle', 'description']);
		$bundle = Bundle::find($id);
		$bundle->type = $request->type;
		$bundle->revise($values);
		
		$bundle->save();
		
		return response()->backend($bundle);
    }
    
}
