<?php

namespace LILPLP\IBA\Http\Controllers;

use Illuminate\Http\Request;
use LILPLP\IBA\Http\Controllers\BookController;

use LILPLP\IBA\Bundle;

class BundleController extends BookController
{
    //
    public $type = 'bundle';
// 	public $roles = ['inspired', 'author', 'dedicated'];
// 	public $bundleTypes = ['selection'];
    
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
    
    public function update(Request $request, Bundle $bundle)
    {
	    $this->validate($request, [
	        'title' => 'required'
	    ]);
	    $values = $request->only(['title', 'slug', 'subtitle', 'description']);
		
		$bundle->revise($values);
		
		$bundle->save();
		
		return response()->backend($bundle);
    }
    
}
