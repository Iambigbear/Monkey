<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'auth'],function(){
    Route::get('/','AdminHomeController@index');
    Route::get('view', 'PhotosController@index');
    Route::post('upload','PhotosController@upload');
    Route::get('download/{id}','PhotosController@download');
    Route::delete('remove/{id}','PhotosController@remove');
    Route::resource('photos','PhotosController');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
