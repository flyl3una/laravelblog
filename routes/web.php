<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['namespace' => 'Site'], function() {
//    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/blog', 'ArticleController@index')->name('blog.index');
    Route::get('/blog/{id}', 'ArticleController@show')->name('article.show');
    Route::get('/', function () {
        return redirect(route("blog.index"));
    })->name("root");

});


Route::group([ 'prefix' => 'Auth'], function() {

});