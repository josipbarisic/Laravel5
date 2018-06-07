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
use Carbon\Carbon;




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
        $this->validate($request, [
            'lang' => 'required',
        ]); 
        

        
        $req = $request -> input('per_page');
        
        //RELACIJE

        /* $lang = Languages::where('langkey', $req)->first();
        $meal = Meal::pluck('id');

        $lang2 = MealTranslations::where('language_id', $lang->id);
        $langmeal = MealTranslations::where('meal_id', $meal)->where('language_id', $lang); */
        $cat = Category::pluck('id');
        $cat_id = Meal::where('category_id', $cat);
        $pm = Meal::where('id', '>', 7);
        $pm->delete();

        $all_meals = Meal::select('jela.*')
         ->leftJoin('jelo_tag', 'jela.id', '=', 'jelo_tag.jelo_id')
         ->leftJoin('tags', 'tags.id', '=', 'jelo_tag.tag_id')
         ->leftJoin('meal_translations', 'jela.id', '=', 'meal_translations.meal_id')
         ->leftJoin('languages', 'meal_translations.language_id', '=', 'languages.id')
         ->orderBy('id')
         ->distinct(); 
        $all_meals = $this->filter($request, $all_meals);
        return $all_meals->paginate($req); 
      
    }

    //          FUNKCIJA ZA FILTRIRANJE PODATAKA IZ BAZE PO PARAMETRIMA
    public function filter(Request $request, $all_meals)
    {   
        /* $langRequest = $request->validate([
            'lang'=>'required'
        ]); */

        $reqL = $request->input('lang');
        /* $lang = Languages::where('langkey', $reqL)->first();

        //$meal = Meal::pluck('id');
        $lang = MealTranslations::where('language_id', $lang->id); */
     
        //$langmeal = MealTranslations::where('meal_id', $meal)->where('language_id', $lang);
        
        
        if($reqL == 'hr')
        {
            $all_meals;
        }

        if($reqL == 'en'||$reqL == 'es'||$reqL == 'fr')
        {
            $lang = Languages::where('langkey', $reqL)->pluck('id');

            $all_meals = MealTranslations::where('language_id','=', $lang);

            /* $all_meals = MealTranslations::select('meal_translations.*')
            ->leftJoin('category_translations','meal_translations.'); */
        }
            
        

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
            $all_meals = $all_meals->with(explode(',', $request->input('with')));
        }
        
        if ($request->has('diff_time'))
        {
            $timestamp = $request->input('diff_time');
            $time = Carbon::createFromTimestamp($timestamp)->format('Y-m-d');
            $all_meals = $all_meals->whereDate('updated_at', '<', $time); 

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
