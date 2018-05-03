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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//ingredient 

//Route::post('/ingredient-form', ['as' => '/ingredient-form', 'uses' => 'IngredientController@succ']);

Route::post('/ingredient/create', 'IngredientController@save')->name('save_ingr');

Route::get('/ingredient/all', 'IngredientController@index')->name('show_ingredients');

Route::get('/ingredient/{id}', 'IngredientController@show')->name('show_ing_id');

Route::post('/ingredient/edit', 'IngredientController@edit')->name('edit_ing');

Route::post('/ingredient/delete', 'IngredientController@delete')->name('delete_ing');

//category 


Route::post('/category/create', 'CategoryController@save')->name('saved');

Route::get('/category/all', 'CategoryController@index')->name('show_category');

Route::get('/category/{id}', 'CategoryController@show')->name('category');

Route::post('/category/edit', 'CategoryController@edit')->name('category_edit');

Route::post('/category/delete', 'CategoryController@delete')->name('delete_cat');

//tag

Route::post('/tag/create', 'TagController@create_save')->name('save_tag');

Route::get('/tag/all', 'TagController@index')->name('show_tags');

Route::get('/tag/{id}', 'TagController@show')->name('show_tag');

Route::post('/tag/edit', 'TagController@edit')->name('edit_tag');

Route::post('/tag/delete', 'TagController@delete')->name('delete_tag');

//meal
Route::post('/meal/create', 'MealController@create_save')->name('save_meal');

Route::get('/meal/all', 'MealController@index')->name('show_meals');

Route::get('/meal/{id}', 'MealController@show')->name('show_meal');

Route::post('/meal/edit', 'MealController@edit')->name('edit_meal');

Route::post('/meal/delete', 'MealController@delete')->name('delete_meal');


