<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::prefix('api')->namespace('LILPLP\IBA\Http\Controllers')->group(function () {
	
	Route::middleware('auth:api')->get('/user', function (Request $request) {
	    return $request->user();
	});
	
	
	Route::get('/keywords/', 'LILPLP\IBA\Http\Controllers\ApiControlle@keywords');
	Route::get('/people/', 'LILPLP\IBA\Http\Controllers\ApiControlle@people');
	
	Route::get('/', 'LILPLP\IBA\Http\Controllers\ApiControlle@apiIndex');
// 	Route::get('/', function () {return "Hi";});
	Route::post('/post/', 'PostController@store')->middleware('auth:api');
	Route::get('/post/create', 'PostController@apiCreate');
	
	Route::middleware('auth:api')->group(function () {
		
		Route::get('/backend/article/', 'Journal\ArticleController@manage');
		Route::get('/backend/article/create/', 'Journal\ArticleController@create');
		Route::post('/backend/article/', 'Journal\ArticleController@store');
		Route::get('/backend/article/{id}/edit', 'Journal\ArticleController@edit');
		Route::patch('/backend/article/{article}/', 'Journal\ArticleController@update');
		
		Route::get('/backend/idea/', 'IdeaController@manage');
		Route::get('/backend/idea/create/', 'IdeaController@create');
		Route::post('/backend/idea/', 'IdeaController@store');
		Route::get('/backend/idea/{id}/edit', 'IdeaController@edit');
		Route::put('/backend/idea/{id}/', 'IdeaController@update');
		
		Route::post('/backend/bundle/', 'BundleController@store');
		Route::get('/backend/bundle/create/', 'BundleController@create');
		Route::get('/backend/bundle/{id}/edit', 'BundleController@edit');
		Route::put('/backend/bundle/{bundle}/', 'BundleController@update');
		Route::get('/backend/bundle/', 'BundleController@manage');
		
		Route::get('/backend/poem/', 'PoemController@manage');
		Route::get('/backend/poem/create/', 'PoemController@create');
		Route::get('/backend/poem/{id}/edit', 'PoemController@edit');
		Route::put('/backend/poem/{poem}/', 'PoemController@update');
		Route::post('/backend/poem/', 'PoemController@store');
		
		Route::patch('/backend/post/{post}/', 'PostController@update');
		Route::get('/backend/post/{post}/edit', 'PostController@edit');
		Route::get('/backend/post/create/', 'PostController@create');
		Route::post('/backend/post/', 'PostController@store');
		Route::get('/backend/post/', 'PostController@manage');
		
		Route::get('/backend/', 'LILPLP\IBA\Http\Controllers\ApiControlle@index')->name('backend.index');
	});
});
*/

