<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function showAllCategories(){
        $categories=Category::all();
        // dd($categories);
        return view('welcome',compact('categories'));
    }
}
