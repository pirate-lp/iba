<?php

namespace LILPLP\IBA\Http\Controllers;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;

use LILPLP\IBA\Keyword;
use LILPLP\IBA\People;

class ApiController extends Controller
{
    //
    static $bookTypes = ['article', 'poem', 'idea', 'post'];
    
    public function keywords()
    {
	    return Keyword::all();
    }
    
    public function people()
    {
	    return People::all();
    }
    
    public function start()
    {
	    return view('iba::backend.apiIndex');
    }
    
    public function apiIndex()
    {
	    return static::$bookTypes;
    }
}
