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
        {
            return view('meals.create_ingredients');
        }
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'slug'=>'required',

        ]);

        $ingredient=new Ingredient;
        $ingredient->title=$request->title;
        $ingredient->slug=str_slug($request->slug, '-');
        $ingredient->save();
        
        //$ingredient = ingredient::create($request->all());
        //dd("test");
        //route('routeName', ['id' => 1]);
        return $ingredient;
        /*if(isset($_GET['title']) && isset($_GET['slug']))
        {
            $gettitle=$_GET['title'];
            $getslug=$_GET['slug'];
            $titleslug=mysql_query('INSERT INTO SITE (title, slug) VALUES('. $gettitle. ',' .str_slug($getslug). ')') or die(mysql_error());
            
            return redirect()->route('ingredient', ['id' => $ingredient->id])->with('message','ingredient Created (GET)');
        }*/
        //$ingredient = ingredient::create($request->all());
        //dd("test");
        //route('routeName', ['id' => 1]);
    }

    public function index()
    {
        
        return Ingredient::all();
    }

    public function show($id)
    {
        
        return Ingredient::find($id);
    }

    public function edit(Request $request, $id)
    {
       $this->validate($request, 
       [
        'title'=>'required',
        'slug'=>'required',
       ]);

        $ingredient=Ingredient::find($id);
        $ingredient->title=$request->title;
        $string='-ingredientSlug';
        $ingredient->slug=str_slug($request->slug, '-').$string;
        $ingredient->save();

        return Ingredient::find($id);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
}
