<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('lang/{lang}',[LanguageController::class, 'switch'])->name('lang.switch');

Route::name('auth.')
->prefix('admin')
->middleware('guest','preventback')
->controller(AuthController::class)
->group(function(){
  Route::get('login','login')->name('login');
  Route::post('login','loginEvent')->name('loginEvent');
});

Route::middleware('auth')->get('logout',[AuthController::class, 'logout'])->name('auth.logout');


Route::name('admin.')
->prefix('admin')
->middleware('auth','preventback','role:admin|super_admin')
->group(function(){
    Route::get('/',[DashboardController::class, 'index'])->name('dashboard');

    Route::resource('articles',ArticleController::class)->except('show');
    Route::middleware('role:super_admin')->get('articles/{article}',[ArticleController::class,'destroy'])->whereNumber('id')->name('articles.destroy');

    Route::resource('categories',CategoryController::class)->except('show');
    Route::middleware('role:super_admin')->get('categories/{category}',[CategoryController::class,'destroy'])->whereNumber('id')->name('categories.destroy');
});
