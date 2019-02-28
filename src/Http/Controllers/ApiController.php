<?php

namespace IAtelier\Atelier\Http\Controllers;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;

use IAtelier\Atelier\Keyword;
use IAtelier\Atelier\People;

class ApiController extends Controller
{
    //
    public $bookTypes;
    
    public function __construct() {
	    $this->bookTypes = config('atelier.book_types');
    }
    
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
	    return view('atelier::digital.index');
    }
    
    public function apiIndex()
    {
	    return $this->bookTypes;
    }
}
