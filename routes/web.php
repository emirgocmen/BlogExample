<?php

use App\Http\Controllers\MainController;

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

Route::name('front.')
->controller(MainController::class)
->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('{category_slug}', 'category')->where('category_slug', '[a-z]+')->name('category');
    Route::get('{category_slug}/{article_slug}', 'detail')->name('detail');
});




