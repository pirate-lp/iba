<?php

namespace LILPLP\IBA\Http\Controllers;

use LILPLP\IBA\People;
use LILPLP\IBA\Keyword;

use Illuminate\Routing\Controller as Controller;

class BackendController extends Controller
{
    //
    static $bookTypes = ['article', 'poem', 'idea', 'post'];

    public function index()
    {
// 	    return "hi";
	    return view('iba::backend.index');
    }

    public function keywords()
    {
	    return Keyword::all();
    }

    public function people()
    {
	    return People::all();
    }

    public function apiHome()
    {
	    return view('backend.apiIndex');
    }

    public function apiIndex()
    {
	    return static::$bookTypes;
    }
}
