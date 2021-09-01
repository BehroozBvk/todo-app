<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'articles', 'middleware' => ['auth']], function () {
        Route::get('/', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles');
        Route::get('create', [App\Http\Controllers\ArticleController::class, 'create'])->name('articles.create');
        Route::post('store', [App\Http\Controllers\ArticleController::class, 'store'])->name('articles.store');
        Route::get('{article:slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');
        Route::get('edit/{article}', [App\Http\Controllers\ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('update/{article}', [App\Http\Controllers\ArticleController::class, 'update'])->name('articles.update');
        Route::delete('edit/{article}', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('articles.destroy');
    });

});

Route::group(['prefix' => 'articles', 'middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\ArticleController::class, 'list'])->name('articles.list');
    Route::get('{article:slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');
});
