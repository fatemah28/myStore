<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
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
Route::get('/', [CategoryController::class,'showAllCategories']);
Route::get('/about', [AboutController::class,'index'])->name('about');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/categories', [App\Http\Controllers\HomeController::class, 'showCategories'])->name('categories');
Route::get('/admin/categories/create', [App\Http\Controllers\HomeController::class, 'adminCreateCategory'])->name('adminCreateCategory');
Route::post('/admin/categories/store', [App\Http\Controllers\HomeController::class, 'adminCategoryStore'])->name('adminCategoryStore');
