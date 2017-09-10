<?php

namespace LILPLP\IBA\Http\Controllers;

use LILPLP\IBA\People;
use LILPLP\IBA\Keyword;

use Illuminate\Routing\Controller as Controller;

class BackendController extends Controller
{
    //
    public $bookTypes;
    
    public function __construct() {
	    $this->bookTypes = config('iba.book_types');
    }
    
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
	    return $this->bookTypes;
    }
}
