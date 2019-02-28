<?php

namespace IAtelier\Atelier\Http\Controllers;

use IAtelier\Atelier\People;
use IAtelier\Atelier\Keyword;

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
		$this->books = config('atelier.book_types');
	}
	
	public function index()
	{
		$books = [];
		foreach ($this->books as $key => $book)
		{
			$request = Request::create('atelier/analog/' . $book . '/dashboard/', 'GET');
			$response = app()->handle($request);
			$books[$key] = json_decode($response->content());
			
		}
		return view('atelier::index', compact('books'));
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
