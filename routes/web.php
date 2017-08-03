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

Route::get('/', function () {
    return redirect(route("blog.index"));
})->name("root");

Route::group(['namespace' => 'Site', 'prefix' => 'blog'], function() {
//    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'ArticleController@index')->name('blog.index');
    Route::get('/{id}', 'ArticleController@show')->where('id', '[0-9]')->name('article.show');
});


Route::group([ 'prefix' => 'Auth'], function() {

});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
//   Route:resource("/manager")
});