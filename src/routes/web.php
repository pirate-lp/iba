<?php

use IAtelier\Atelier\Http\Middleware\CheckEditor as Editor;

Route::prefix('/atelier')->namespace('IAtelier\Atelier\Http\Controllers')->middleware(['web', 'auth', Editor::class])->group( function() {
	
	Route::get('/analog/', 'AnalogController@index');
	
	Route::prefix('/analog/bundle')->group( function() {
		Route::get('/', 'BundleController@manage');
		Route::post('/', 'BundleController@store');
		Route::get('/create/', 'BundleController@create');
		Route::get('/{id}/edit', 'BundleController@edit');
		Route::put('/{id}/', 'BundleController@update');
	});
	
});



Route::prefix('/atelier/api')->namespace('IAtelier\Atelier\Http\Controllers')->middleware(['web', 'auth'])->group( function() {
	
});

Route::prefix('/api/atelier')->namespace('IAtelier\Atelier\Http\Controllers')->middleware(['api', 'auth:api'])->group( function() {
	
	Route::prefix('/bundle')->group(function() {
		Route::get('/', 'BundleController@manage');
		Route::post('/', 'BundleController@store');
		Route::get('/create/', 'BundleController@create');
		Route::get('/{id}/edit', 'BundleController@edit');
		Route::put('/{id}/', 'BundleController@update');
	});
});


Route::namespace('IAtelier\Atelier\Http\Controllers')->group( function() {
	
	Route::get('/atelier/digital/', 'ApiController@start');
	
	Route::get('/atelier/', 'ApiController@apiIndex');
	
	Route::get('/atelier/bundle/create', function(){
					return "Hi";
				})->middleware('auth');
	
	Route::prefix('api')->group(function () {
		
		Route::middleware('auth:api')->get('/user', function (Request $request) {
		    return $request->user();
		});
		
		Route::get('/keywords/', 'ApiController@keywords');
		Route::get('/people/', 'ApiController@people');
		
		Route::get('/', 'ApiController@apiIndex');
		
		Route::middleware('auth:api')->group(function () {
			
			Route::get('/backend/', 'IAtelier\Atelier\Http\Controllers\ApiController@index')->name('backend.index');
			
		});
	});

});
