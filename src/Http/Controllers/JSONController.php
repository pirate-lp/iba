<?php

namespace App\Http\Controllers;

use App;
use IAtelier\Atelier\Keyword;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    //
    static $bookTypes = ['article', 'poem', 'idea', 'post'];
    
    public function index()
    {
// 	    return "hi";
	    return view('backend.index');
    }
    
    public function keywords()
    {
	    return Keyword::all();
    }
    
    public function people()
    {
	    return \App\People::all();
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
