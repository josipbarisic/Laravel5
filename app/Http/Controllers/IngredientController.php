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
      //  $this->middleware('auth');
    }
    

    
    
    public function succ()
    {
      
    }
    public function create()
    {
        return view('meals.create_ingredients');
    }

    public function save(Request $request)
    {
      //  dd($request->all());
        $this->validate($request, [
            'title'=>'required',
            'slug'=>'required',

        ]);

        $ingredient=new ingredient;
        $ingredient->title=$request->title;
        $ingredient->slug=str_slug($request->slug, '-');
        $ingredient->save();
        
        //$ingredient = ingredient::create($request->all());
        //dd("test");
        //route('routeName', ['id' => 1]);
        return redirect()->route('ingredient', ['id' => $ingredient->id])->with('message','ingredient Created');
    }

    public function show($id)
    {
        
        return 'ADDED';
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
}
