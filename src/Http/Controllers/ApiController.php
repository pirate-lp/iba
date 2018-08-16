<?php

namespace PirateLP\IBA\Http\Controllers;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;

use PirateLP\IBA\Keyword;
use PirateLP\IBA\People;

class ApiController extends Controller
{
    //
    public $bookTypes;
    
    public function __construct() {
	    $this->bookTypes = config('iba.book_types');
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
	    return view('iba::digital.index');
    }
    
    public function apiIndex()
    {
	    return $this->bookTypes;
    }
}
