<?php

Route::group(['middleware' => 'web', 'prefix' => 'api/v1/blogs', 'namespace' => 'Modules\Blog\Http\Controllers'], function()
{
	Route::get('/', 'BlogController@index');
	Route::get('/{id}', 'BlogController@find');
	Route::get('/hello', 'BlogController@hello');
});