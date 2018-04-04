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

Route::get('/', function () {
    return view('welcome');
});


//category form
Route::get('/category-form', function () {
   
    return view('pages.pogled');
});
Route::get('/create-category', 'CategoryController@create');

Route::post('/category-form', ['as' => '/category-form', 'uses' => 'CategoryController@succ']);

Route::post('/category-form', 'CategoryController@save')->name('saved');

Route::get('/category/{id}', 'CategoryController@show_category')->name('category');

//posts
Route::get('/form', function () {
   
    return view('pages.pogled');
});
Route::get('/create', 'HomeController@create');
Route::post('/form', ['as' => '/form', 'uses' => 'HomeController@succ']);

Route::post('/form', 'HomeController@spremi')->name('test');

Route::get('/posts/{id}', 'HomeController@show')->name('postovi');
//Auth::routes();

Route::get('/jela', function () {
   
    return view('pages.jela');
});
Route::get('/jela', 'FDController@show_tags')->name('jela');
