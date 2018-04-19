<?php

namespace App\Http\Controllers;

use App\models\Meal;
use App\models\Category;
use App\models\Ingredient;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\models\Jelo_Ingredient;


class MealController extends Controller
{
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    public function create_save(Request $request)
    {

        $this->validate($request, [
            
            'title'=>'required',
            'slug'=>'required',
            'category_id'=>'exists:category,id',
            'ingredient_id'=>'required|exists:ingredients,id',
            'tag_id'=>'required|exists:tags,id',
        ]);
        $meal=new Meal;
        $meal->title=$request->title;
        $string = '-mealSlug';
        $meal->slug=str_slug($request->slug, '-').$string;
        
        if ($request->filled('category_id')) 
        {
            $meal->category_id=$request->category_id;
        }
        $meal->save();
        $meal->ingredients()->sync([
            $request->ingredient_id
        ]);
        
        $meal->tags()->sync([
                $request->tag_id,
            ]
            );


        return $meal;

        //$meal = Meal::create($request->all());
        //dd("test");
        //route('routeName', ['id' => 1]);
        
        /*if(isset($_GET['title']) && isset($_GET['slug']))
        {
            $gettitle=$_GET['title'];
            $getslug=$_GET['slug'];
            $titleslug=mysql_query('INSERT INTO SITE (title, slug) VALUES('. $gettitle. ',' .str_slug($getslug). ')') or die(mysql_error());
            
            return redirect()->route('meal', ['id' => $meal->id])->with('message','meal Created (GET)');
        }*/
        //$meal = meal::create($request->all());
        //dd("test");
        //route('routeName', ['id' => 1]);
    }

    public function index()
    {
        return Meal::all();
    }

    public function show($id)
    {
        Meal::withTrashed()->where('id', 19)->restore();
        //return Meal::find($id);
    }



    public function edit(Request $request)
    {
       $this->validate($request, 
       [
        'id'=>'required',
       ]);

       $meal=Meal::find($request->id);
       
        if($meal==NULL)
        {
            return 'Ne postoji';
        }
        if($request->filled('title'))
        {
            $meal->title=$request->title;
        }
        $string='-mealSlug';
        if($request->filled('slug'))
        {
        $meal->slug=str_slug($request->slug, ' ').$string;
        }
        
            $meal->ingredients()->attach([
                $request->ingredient_id
            ]);
            
            $meal->tags()->attach([
                    $request->tag_id,
                ]
                );

        $meal->save();

        return Meal::find($request->id);
    }

    //soft delete
    public function delete(Request $request)
    {
        $this->validate($request, 
       [
        'id'=>'required'
       ]);

        $meal=Meal::find($request->id);
        
        $collect_ingid = $meal->ingredients()->pluck('ingredients.id');
        $collect_tagid = $meal->tags()->pluck('tags.id');
        
        $meal->ingredients()->detach([
            $collect_ingid,
        ]);

        $meal->tags()->detach([
            $collect_tagid,
        ]);

        $meal->delete();

        return 'Deleted'.$meal;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
}
