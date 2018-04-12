<?php

namespace App\Http\Controllers;

use App\models\Meal;
use DB;
use Illuminate\Http\Request;

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

        ]);

        $meal=new Meal;
        $meal->title=$request->title;
        $meal->slug=str_slug($request->slug, '-');
        $meal->save();
        
        //$meal = meal::create($request->all());
        //dd("test");
        //route('routeName', ['id' => 1]);
        return $meal;
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
        
        return Meal::find($id);
    }

    public function edit(Request $request, $id)
    {
       $this->validate($request, 
       [
        'title'=>'required',
        'slug'=>'required',
       ]);
       
        $meal=Meal::find($id);
        $meal->title=$request->title;
        $string='-mealSlug';
        $meal->slug=str_slug($request->slug, '-').$string;
        $meal->save();

        return meal::find($id);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
}