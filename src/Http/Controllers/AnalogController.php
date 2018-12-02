<?php

namespace PirateLP\IBA\Http\Controllers;

use PirateLP\IBA\People;
use PirateLP\IBA\Keyword;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Routing\ResponseFactory;

class AnalogController extends Controller
{
	//
	public $books;
	
	public function __construct() {
		$this->books = config('iba.book_types');
	}
	
	public function index()
	{
		$books = [];
		foreach ($this->books as $key => $book)
		{
			$request = Request::create('iba/analog/' . $book . '/dashboard/', 'GET');
			$response = app()->handle($request);
			$books[$key] = json_decode($response->content());
			
		}
		return view('iba::index', compact('books'));
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
		return $this->books;
	}
	
}
