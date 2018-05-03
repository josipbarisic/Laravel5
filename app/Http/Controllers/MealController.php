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
            
            'title' => 'required',
            'slug' => 'required',
            'category_id' => 'exists:category,id',
            'ingredient_id' => 'required|exists:ingredients,id',
            'tag_id' => 'required|exists:tags,id',
        ]);
        $meal = new Meal;
        $meal->title = $request->title;
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
    }

    public function index(Request $request)
    {
        /* $this->validate($request, [
            'lang' => 'required|exists:languages,language_id',
        ]); */
        
        $join = DB::table('jela')->crossJoin('meal_translations')->get();

        $all_meals = Meal::with('category','tags','ingredients','meal_translations');//->where('language_id', $request->language_id);//->paginate(1);
        //return $all_meals->simplePaginate($request->input('per_page', 2)); 

        dd($join);
    }

    public function show($id)
    {
        
        $onemeal = Meal::with('meal_translations')->find($id);
        
        $eng = $onemeal->meal_translations->where('language_id', 1)->pluck('title')->pull(0);
        $esp = $onemeal->meal_translations->where('language_id', 2)->pluck('title')->pull(0);
        $frn = $onemeal->meal_translations->where('language_id', 3)->pluck('title')->pull(0);
        
        return view ('pages.jela')->with('onemeal', $onemeal)->with('eng', $eng)->with('esp', $esp)->with('frn', $frn);
    }

    public function edit(Request $request)
    {
       $this->validate($request, 
       [
        'id'=>'required',
       ]);

       $meal=Meal::find($request->id);
       
        if($meal == NULL)
        {
            return 'Ne postoji';
        }
        if($request->filled('title'))
        {
            $meal->title=$request->title;
        }
        $string = '-mealSlug';
        if($request->filled('slug'))
        {
        $meal->slug=str_slug($request->slug, ' ').$string;
        }
        
        $meal->ingredients()->sync([
             $request->ingredient_id
        ]);
            
         $meal->tags()->sync([
            $request->tag_id,
        ]);

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

        $meal = Meal::find($request->id);
        //dd($meal->ingredients()->get());
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
