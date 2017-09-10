<?php

namespace LILPLP\IBA\Http\Controllers;

use Illuminate\Routing\Controller as Controller;
use LILPLP\IBA\Page;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public $type;
    public $uri;
    protected $slug;
    public $base;
    
    public function show (Request $request, $any = null) {
		$uri = $request->path();
		$page = new Page($uri);
		if ( $page )
		{
			return $page->show();
		}
		else
		{
			abort(404);
		}
	}
}
