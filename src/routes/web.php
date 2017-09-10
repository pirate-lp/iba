<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 
// Route::get('/{idea}/', 'IdeaController@show');
use LILPLP\IBA\Http\Controllers\BackendController as BackendController;
use LILPLP\IBA\Http\Controllers\PageController as PageController;
use LILPLP\IBA\Http\Controllers\ApiController as ApiController;

Route::namespace('LILPLP\IBA\Http\Controllers')->group(function() {
	
	Route::get('/backend/', 'BackendController@index')->name('backend.index');
	
	Route::get('/api/home/', 'ApiController@start');
	
	Route::get('/api/', 'ApiController@apiIndex');
	
	// dd(Request::path());
	
	/*
	Route::post('/backend/bundle/', 'BundleController@store');
		Route::get('/backend/bundle/create/', 'BundleController@create');
		Route::get('/backend/bundle/{id}/edit', 'BundleController@edit');
		Route::put('/backend/bundle/{bundle}/', 'BundleController@update');
		Route::get('/backend/bundle/', 'BundleController@manage');
	*/
	
	
	
	Route::prefix('api')->group(function () {
		
		Route::middleware('auth:api')->get('/user', function (Request $request) {
		    return $request->user();
		});
		
		
		Route::get('/keywords/', 'ApiController@keywords');
		Route::get('/people/', 'ApiController@people');
		
		Route::get('/', 'ApiController@apiIndex');
	// 	Route::get('/', function () {return "Hi";});
	/*
		Route::post('/post/', 'PostController@store')->middleware('auth:api');
		Route::get('/post/create', 'PostController@apiCreate');
	*/
		
		Route::middleware('auth:api')->group(function () {
			
	/*
			Route::get('/backend/article/', 'Journal\ArticleController@manage');
			Route::get('/backend/article/create/', 'Journal\ArticleController@create');
			Route::post('/backend/article/', 'Journal\ArticleController@store');
			Route::get('/backend/article/{id}/edit', 'Journal\ArticleController@edit');
			Route::patch('/backend/article/{article}/', 'Journal\ArticleController@update');
	*/
			
	/*
			Route::get('/backend/idea/', 'IdeaController@manage');
			Route::get('/backend/idea/create/', 'IdeaController@create');
			Route::post('/backend/idea/', 'IdeaController@store');
			Route::get('/backend/idea/{id}/edit', 'IdeaController@edit');
			Route::put('/backend/idea/{id}/', 'IdeaController@update');
			
	*/
			Route::post('/backend/bundle/', 'BundleController@store');
			Route::get('/backend/bundle/create/', 'BundleController@create');
			Route::get('/backend/bundle/{id}/edit', 'BundleController@edit');
			Route::put('/backend/bundle/{bundle}/', 'BundleController@update');
			Route::get('/backend/bundle/', 'BundleController@manage');
			
	/*
			Route::get('/backend/poem/', 'PoemController@manage');
			Route::get('/backend/poem/create/', 'PoemController@create');
			Route::get('/backend/poem/{id}/edit', 'PoemController@edit');
			Route::put('/backend/poem/{poem}/', 'PoemController@update');
			Route::post('/backend/poem/', 'PoemController@store');
			
	*/
	/*
			Route::patch('/backend/post/{post}/', 'PostController@update');
			Route::get('/backend/post/{post}/edit', 'PostController@edit');
			Route::get('/backend/post/create/', 'PostController@create');
			Route::post('/backend/post/', 'PostController@store');
			Route::get('/backend/post/', 'PostController@manage');
	*/
			
			Route::get('/backend/', 'LILPLP\IBA\Http\Controllers\ApiController@index')->name('backend.index');
		});
	});
	
/*
	$app->error(function(Exception $exception, $code)
	{
		Route::get('{any?}','PageController@show')->where('any', '.*');
		Log::error($exception);
		
		if (Config::get('app.debug') == false) {
		    return Redirect::route('404');
		}
	});
*/
/*
	App::missing(function($exception)
    {

        // shows an error page (app/views/error.blade.php)
        // returns a page not found error
        Route::get('{any?}','PageController@show')->where('any', '.*');
        return Response::view('error', array(), 404);
    });
*/
// 	Route::get('{any?}','PageController@show')->where('any', '.*');


});
