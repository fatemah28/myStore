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
Route::get('/admin/categories/edit/{id}', [App\Http\Controllers\HomeController::class, 'adminEditCategory'])->name('adminEditCategory');
Route::post('/admin/categories/update/{id}', [App\Http\Controllers\HomeController::class, 'adminCategoryUpdate'])->name('adminCategoryUpdate');
Route::get('/admin/categories/delete/{id}', [App\Http\Controllers\HomeController::class, 'adminDeleteCategory'])->name('adminDeleteCategory');
Route::post('/admin/categories/destroy/{id}', [App\Http\Controllers\HomeController::class, 'adminCategoryDestroy'])->name('adminCategoryDestroy');
