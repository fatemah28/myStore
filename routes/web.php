<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\admin\AdminCategoryController;
use App\Http\Controllers\admin\AdminProductController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });


Route::middleware('auth')->group(function () {
    // Other client routes...
    Route::post('/addToCart', [HomeController::class,'addToCart'])->name('addToCart');
    Route::post('/updateCart', [HomeController::class,'updateCart'])->name('updateCart');
    Route::post('/removeItem', [HomeController::class,'removeItem'])->name('removeItem');
    Route::get('/cart/pdf', [HomeController::class, 'downloadCartPdf'])->name('downloadPdf');
    Route::get('/cart', [HomeController::class,'cart'])->name('cart');
    Route::get('/cart/table', [HomeController::class,'updateCartTable'])->name('cart.update');
       
});
Route::middleware('admin')->group(function () {
    Route::get('/admin', [DashboardController::class,'showDashboardPage'])->name('showDashboardPage');
        //This Routs for admin to control in the categories
    Route::get('/admin/categories', [AdminCategoryController::class, 'showCategories'])->name('adminCategories');
    Route::get('/admin/categories/create', [AdminCategoryController::class, 'adminCreateCategory'])->name('adminCreateCategory');
    Route::post('/admin/categories/store', [AdminCategoryController::class, 'adminCategoryStore'])->name('adminCategoryStore');
    Route::get('/admin/categories/edit/{id}', [AdminCategoryController::class, 'adminEditCategory'])->name('adminEditCategory');
    Route::post('/admin/categories/update/{id}', [AdminCategoryController::class, 'adminCategoryUpdate'])->name('adminCategoryUpdate');
    Route::get('/admin/categories/delete/{id}', [AdminCategoryController::class, 'adminDeleteCategory'])->name('adminDeleteCategory');
    Route::post('/admin/categories/destroy/{id}', [AdminCategoryController::class, 'adminCategoryDestroy'])->name('adminCategoryDestroy');
    //This Routs for admin to control in the Products
    Route::get('/admin/products', [AdminProductController::class, 'showProducts'])->name('adminProducts');
    Route::get('/admin/products/create', [AdminProductController::class, 'adminCreateProduct'])->name('adminCreateProduct');
    Route::post('/admin/products/store', [AdminProductController::class, 'adminProductStore'])->name('adminProductStore');
    Route::get('/admin/products/edit/{id}', [AdminProductController::class, 'adminEditProduct'])->name('adminEditProduct');
    Route::post('/admin/products/update/{id}', [AdminProductController::class, 'adminProductUpdate'])->name('adminProductUpdate');
    Route::get('/admin/products/delete/{id}', [AdminProductController::class, 'adminDeleteProduct'])->name('adminDeleteProduct');
    Route::post('/admin/products/destroy/{id}', [AdminProductController::class, 'adminProductDestroy'])->name('adminProductDestroy');
    //This Routs for admin to control in the Users
    Route::get('/admin/users', [AdminUserController::class, 'showUsers'])->name('adminUsers');
    Route::get('/admin/users/create', [AdminUserController::class, 'adminCreateUser'])->name('adminCreateUser');
    Route::post('/admin/users/store', [AdminUserController::class, 'adminUserStore'])->name('adminUserStore');
    Route::get('/admin/users/edit/{id}', [AdminUserController::class, 'adminEditUser'])->name('adminEditUser');
    Route::post('/admin/users/update/{id}', [AdminUserController::class, 'adminUserUpdate'])->name('adminUserUpdate');
    Route::get('/admin/users/delete/{id}', [AdminUserController::class, 'adminDeleteUser'])->name('adminDeleteUser');
    Route::post('/admin/users/destroy/{id}', [AdminUserController::class, 'adminUserDestroy'])->name('adminUserDestroy');

    Route::get('/user/profile', [DashboardController::class,'showProfilePage'])->name('userProfile');
    Route::post('/user/upload/image', [DashboardController::class,'uploadPhoto'])->name('profile.image.upload');
    Route::post('/user/delete/image', [DashboardController::class,'deletePhoto'])->name('profile.image.delete');
    Route::post('/user/profile/update', [DashboardController::class,'saveProfileInfo'])->name('saveProfileInfo');
    Route::post('/user/profile/update/password', [DashboardController::class,'updatePassword'])->name('updatePassword');
    Route::get('/admin/cart/user/{id}', [DashboardController::class,'showUserItems'])->name('showUserItems');
});

// Route::get('/admin', [DashboardController::class,'showDashboardPage']);
Route::get('/about', [AboutController::class,'index'])->name('about');
Route::get('/', [HomeController::class,'index']);
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/products/{id}', [HomeController::class,'getProductsByCategory'])->name('getProductsByCategory');
Route::get('/products', [HomeController::class,'GetClientProducts'])->name('GetClientProducts');
Route::get('/shop', [HomeController::class,'shop'])->name('shop');

Auth::routes();

// // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
