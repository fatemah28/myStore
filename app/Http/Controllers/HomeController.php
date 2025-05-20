<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function __construct(){
    //     $this->middleware('auth')->only('addToCart');
    // }
    public function index()
    {
        $categories = Category::all();
        // dd($categories);
        return view('client.home', compact('categories'));
    }
    public function GetClientProducts()
    {
        $products = Product::get();
        // dd($products);
        return view('client.Products', compact('products'));
    }
    public function getProductsByCategory($id)
    {
        $category = Category::find($id);
        // dd($category);
        $products = Product::where('category_id', $category->id)->get();
        // dd($products);
        return view('client.ProductsByCategory', compact('products', 'category'));
    }
    public function shop()
    {
        $categories = Category::all();
        // dd($category);
        $products = Product::paginate(6);
        // dd($products);
        return view('client.shop', compact('products', 'categories'));
    }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        // dd($product);
        // try {
            $cartItem = Cart::where('user_id', $request->user_id)
                        ->where('product_id', $request->product_id)
                        ->first();
            // dd($cartItem);
            if ($cartItem) {
                $cartItem->quantity++;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id,
                    'price' => $product->price,
                    'quantity' => $request->quantity
                ]);
                return response()->json(['message' => 'Product added to cart!']);
            }
            //    }
        // } catch (\Exception $e) {
            // return response()->json(['message' => 'An error occurred'], 500);
        // }
    }
    public function cart()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        $itemsForAuthUser = Cart::where('user_id', auth()->user()->id)->get();
        $totalSum = $itemsForAuthUser->sum(function ($item) {
            return $item->quantity * $item->price;
        });
        // dd($itemsForAuthUser);
        return view('client.cart', compact('cart', 'totalSum'));
    }
    public function updateCart(Request $request)
    {
        $item = Cart::find($request->item_id);

        try {
            $item->update([
                'quantity' => $request->quantity,

            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], 500);
        }
        $itemsForAuthUser = Cart::where('user_id', auth()->user()->id)->get();
        $totalSum = $itemsForAuthUser->sum(function ($item) {
            return $item->quantity * $item->price;
        });
        return response()->json([
            'totalSum' => $totalSum,
        ]);
    }
    public function updateCartTable()
    {
        $cart = Cart::where('user_id', auth()->id())->get();
        $totalSum = $cart->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return response()->json([
            'status' => 'success',
            'html' => view('client._cart', compact('cart', 'totalSum'))->render()
        ]);
    }
    public function downloadCartPdf()
    {
        $itemsForAuthUser = Cart::where('user_id', auth()->id())->get();

        // Calculate the total sum
        $totalSum = $itemsForAuthUser->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        // Load the view and pass the data
        $pdf = Pdf::loadView('client.cart_pdf', compact('itemsForAuthUser', 'totalSum'))->setOptions(['defaultFont' => 'sans-serif']);

        // Download the generated PDF
        return $pdf->download('client.cart_pdf');
    }
    public function removeItem(Request $request)
    {
        $item = Cart::find($request->item_id);
        if ($item) {

            $item->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Item removed from cart'
            ]);
        } else {

            return response()->json([
                'status' => 'error',
                'message' => 'Item not found or unauthorized'
            ], 403);
        }
    }
}
