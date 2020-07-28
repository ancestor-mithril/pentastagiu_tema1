<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'MainController@show');

Route::get('/author', 'AuthorController@index');

Route::get('/author/create', 'AuthorController@create');

Route::post('/author', 'AuthorController@store');

Route::get('/author/{id}', 'AuthorController@show');

Route::get('/author/{id}/edit', 'AuthorController@edit');

Route::put('/author/{id}', 'AuthorController@update');

Route::delete('/author/{id}', 'AuthorController@destroy');



/*Route::get('/da', function () {
    return view('da');
});*/
