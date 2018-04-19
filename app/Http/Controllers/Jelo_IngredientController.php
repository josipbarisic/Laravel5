<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Jelo_ingredient;
use DB;
use App\models\Meal;
use App\models\Ingredient;

class Jelo_IngredientController extends Controller
{
    public function create(Request $request)
    {
        $jelo_ing = Jelo_Ingredient::create($request->all());
        $ing = new Ingredient();
        $ing->roles()->attach($ingredientId);
    }
}
