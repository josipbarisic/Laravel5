<?php

namespace App\Http\Controllers;

use App\models\Meal;
use App\models\Category;
use App\models\Tag;
use App\models\Ingredient;
use App\models\Languages;
use App\models\MealTranslations;
use App\models\CategoryTranslations;
use App\models\IngredientTranslations;
use App\models\TagTranslations;
use App\models\JeloIngredient;
use App\models\JeloTag;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;




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
        
        //$join = DB::table('jela')->crossJoin('meal_translations')->get();

        
        $req = $request->input('lang');
        $req2 = $request -> input('per_page');
        //$req3 = $request -> input('tags');
        
        //RELACIJE

        $lang = Languages::where('langkey', $req)->pluck('id')->pull(0);
        $meal = Meal::pluck('id');

        $lang2 = MealTranslations::where('language_id', $lang)->pluck('title');
        $langmeal = MealTranslations::where('meal_id', $meal)->where('language_id', $lang);
        $cat = Category::pluck('id');
        $cat_id = Meal::where('category_id', $cat);

        //LANG = HR

        if($req == 'hr')
        {
            //  JOIN TABLICE TAGS S TABLICOM JELA
            $all_meals = Meal::select('jela.*')
            ->leftJoin('jelo_tag', 'jela.id', '=', 'jelo_tag.jelo_id')
            ->leftJoin('tags', 'tags.id', '=', 'jelo_tag.tag_id')
            ->orderBy('id');

            $all_meals = $this->filter($request, $all_meals);
            return $all_meals->paginate($req2); 
        }
        else
        {

            
            $all_meals = Meal::all();
            foreach($all_meals as $onemeal)
            {
                $translate = $onemeal->meal_translations->where('language_id', $lang);
                $meal_category = $onemeal->category;
                $meal_ingredients = $onemeal->ingredients;
                $meal_tags = $onemeal->tags;
                $collection = collect([$translate, $meal_category, $meal_ingredients, $meal_tags])->all();

                return $collection;
            }

            

        } 
           
    }

    //          FUNKCIJA ZA FILTRIRANJE PODATAKA IZ BAZE PO PARAMETRIMA
    public function filter(Request $request, $all_meals)
    {   
        if($request->has('category_id'))
        {
            $all_meals->where('category_id', '=', $request->category_id);
        }

        if($request->has('tags'))
        {
           $all_meals = $all_meals->where('tag_id', '=', $request->input('tags'))->with('tags');

            /*      DOHVACANJE JELA PREKO TAG_ID PARAMETRA

            $tag = Tag::where('id', $request->input('tags'))->pluck('id')->pull(0);
            $jelo_id = JeloTag::where('tag_id', $tag)->pluck('jelo_id')->pull(0);
            $all_meals = Meal::where('id', $jelo_id); */
        }
        if($request->has('with'))
        {
            $all_meals = $all_meals->with(explode(',',$request->input('with')));
        }
        
        return $all_meals;
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
