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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// route for top 10 recent serached records
Route::get('/top', 'RomanController@recentSearches');

// route for converting the guven number to Roman number
Route::get('/{integer}', 'RomanController@index');

// route to display all the records from the storage
Route::get('/', 'RomanController@showAll');

