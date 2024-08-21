<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function showProducts()
    {
        $products = Product::all();
        return view('dashboard.products.index', compact('products'));
    }
    public function adminCreateProduct()
    {
        $categories = Category::get();
        return view('dashboard.products.create',compact('categories'));
    }
    public function adminProductStore(Request $request)
    {
        // dd($request);
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $imageUrl = $request->file('image')->store('products', 'public');
        $product->image = $imageUrl;
        $product->save();
        return redirect()->route('adminProducts')->with('message', "Product Created Successfully");
    }
    public function adminEditProduct($id)
    {
        $product = Product::find($id);
        $categories = Category::get();
        return view('dashboard.products.edit', compact('product','categories'));
    }
    public function adminProductUpdate(Request $request,$id){
$product=Product::find($id);
    if($request->hasFile('image')){
        Storage::disk('public')->delete($product->image);
        $imageUrl=$request->file('image')->store('products','public');
        $product->update([
            'image'=>$imageUrl,
        ]);
    }
    $product->update([
        'name'=>$request->name,
        'price'=>$request->price,
        'category_id'=>$request->category_id,
    ]);
    return redirect()->route('adminProducts')->with('message','Product Updated Successfully');
}
    public function adminDeleteProduct($id)
    {
        $product = Product::find($id);
        return view('dashboard.products.delete', compact('product'));
    }
    public function adminProductDestroy($id){
$product=Product::find($id);

    $product->delete();
    return redirect()->route('adminProducts')->with('message','Product Deleted Successfully');
}
}
