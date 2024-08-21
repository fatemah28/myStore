<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showCategories()
    {
        $categories = Category::get();
        return view('dashboard.categories.index', compact('categories'));
    }
    public function adminCreateCategory()
    {
        return view('dashboard.categories.create');
    }
    public function adminCategoryStore(Request $request)
    {
        // dd($request);
        $category = new Category();
        $category->name = $request->name;
        $imageUrl = $request->file('image')->store('categories', 'public');
        $category->image = $imageUrl;
        $category->save();
        return redirect()->route('adminCategories')->with('message', "Category Created Successfully");
    }
    public function adminEditCategory($id)
    {
        $category = Category::find($id);
        if ($category) {
            return view('dashboard.categories.edit', compact('category'));
        } else {
            return "you should to be auth";
        }
    }
    public function adminCategoryUpdate(Request $request, $id)
    {
        $category = Category::find($id);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($category->image);
            $imageUrl = $request->file('image')->store('categories', 'public');
            $category->update([
                'image' => $imageUrl,
            ]);
        }
        $category->update([
            'name' => $request->name
        ]);
        return redirect()->route('adminCategories')->with('message', 'Category Updated Successfully');
    }
    public function adminDeleteCategory($id)
    {
        $category = Category::find($id);
        return view('dashboard.categories.delete', compact('category'));
    }
    public function adminCategoryDestroy($id)
    {
        $category = Category::find($id);

        $category->delete();
        return redirect()->route('adminCategories')->with('message', 'Category Deleted Successfully');
    }
}
