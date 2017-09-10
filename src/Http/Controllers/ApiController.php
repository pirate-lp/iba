<?php

namespace LILPLP\IBA\Http\Controllers;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;

use LILPLP\IBA\Keyword;
use LILPLP\IBA\People;

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
	    return view('iba::backend.apiIndex');
    }
    
    public function apiIndex()
    {
	    return $this->bookTypes;
    }
}
