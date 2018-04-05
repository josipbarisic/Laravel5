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

//ingredient form
Route::get('/ingredient-form', function () {
   
    return view('pages.jela');
});
Route::get('/create-ingredient', 'IngredientController@create');

//Route::post('/ingredient-form', ['as' => '/ingredient-form', 'uses' => 'IngredientController@succ']);

Route::post('/ingredient-form', 'IngredientController@save')->name('save_ingr');

Route::get('/ingredient/all', 'IngredientController@index')->name('show_ingredients');

Route::get('/ingredient/{id}', 'IngredientController@show')->name('show_ing_id');

Route::get('/ingredient/{id}/edit', 'IngredientController@edit')->name('edit_ing');





