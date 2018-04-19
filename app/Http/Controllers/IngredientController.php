<?php

namespace App\Http\Controllers;

use App\models\Ingredient;
use DB;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'slug'=>'required',

        ]);

        $ingredient=new Ingredient;
        $ingredient->title=$request->title;
        $string='-ingredientSlug';
        $ingredient->slug=str_slug($request->slug, '-').$string;
        $ingredient->save();

        return $ingredient;
    }

    public function index()
    {
        return Ingredient::all();
    }

    public function show($id)
    {
        
        return Ingredient::find($id);
    }

    public function edit(Request $request)
    {
       $this->validate($request, 
       [
        'title'=>'required',
        'slug'=>'required',
        'id'=>'required'
       ]);

        $ingredient=Ingredient::find($request->id);
        if($ingredient==NULL)
        {
            return 'Ne postoji';
        }

        $ingredient->title=$request->title;
        $string='-ingredientSlug';
        $ingredient->slug=str_slug($request->slug, '-').$string;
        $ingredient->save();

        return $ingredient;
    }

    //soft delete
    public function delete(Request $request)
    {
        $this->validate($request, 
       [
        'id'=>'required'
       ]);
        $ingredient=Ingredient::find($request->id);
        $ingredient->delete();

        return 'Deleted'.$ingredient;
    }
}
