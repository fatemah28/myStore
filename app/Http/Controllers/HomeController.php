<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }
    public function showCategories(){
        $categries=Category::all();
        return view('home',compact('categries'));
    }
    public function adminCreateCategory(){
        return view('admin.categories.create');
    }
    public function adminCategoryStore(Request $request){
// dd($request);
$category=new Category();
$category->name=$request->name;
$imageUrl=$request->file('image')->store('categories','public');
$category->image=$imageUrl;
$category->save();
return redirect()->route('categories')->with('message',"Category Created Successfully");
    }
}
