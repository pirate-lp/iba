<?php

Route::prefix('/iba')->namespace('LILPLP\IBA\Http\Controllers')->middleware(['web', 'auth'])->group( function() {
	
	Route::get('/analog/', 'AnalogController@index');
	
	Route::prefix('/analog/bundle')->group( function() {
		Route::get('/', 'BundleController@manage');
		Route::post('/', 'BundleController@store');
		Route::get('/create/', 'BundleController@create');
		Route::get('/{id}/edit', 'BundleController@edit');
		Route::put('/{id}/', 'BundleController@update');
	});
	
});



Route::prefix('/iba/api')->namespace('LILPLP\IBA\Http\Controllers')->middleware(['web', 'auth'])->group( function() {
	
});

Route::prefix('/api/iba')->namespace('LILPLP\IBA\Http\Controllers')->middleware(['api', 'auth:api'])->group( function() {
	
	Route::prefix('/bundle')->group(function() {
		Route::get('/', 'BundleController@manage');
		Route::post('/', 'BundleController@store');
		Route::get('/create/', 'BundleController@create');
		Route::get('/{id}/edit', 'BundleController@edit');
		Route::put('/{id}/', 'BundleController@update');
	});
});


Route::namespace('LILPLP\IBA\Http\Controllers')->group( function() {
	
	Route::get('/iba/digital/', 'ApiController@start');
	
	Route::get('/iba/', 'ApiController@apiIndex');
	
	Route::get('/iba/bundle/create', function(){
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
			
			Route::get('/backend/', 'LILPLP\IBA\Http\Controllers\ApiController@index')->name('backend.index');
			
		});
	});

});
