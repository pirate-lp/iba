<?php

namespace LILPLP\IBA\Http\Controllers;

use Illuminate\Routing\Controller as Controller;
use LILPLP\IBA\Leaf;

use Illuminate\Http\Request;

class LeafController extends Controller
{
    //
    public $type;
    public $uri;
    protected $slug;
    public $base;
    
    public function show (Request $request, $any = null) {
		$uri = $request->path();
		$leaf = new Page($uri);
		if ( $leaf )
		{
			return $leaf->show();
		}
		else
		{
			abort(404);
		}
	}
}
