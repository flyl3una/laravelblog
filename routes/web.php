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

Route::get('/logout', "Auth\LogoutController@logout")->name('logout');
Auth::routes();

Route::get('/', function () {
    return redirect(route("home.index"));
})->name("root");

Route::resource('test', 'TestController', ['only' => ['index', 'create']]);

Route::group(['namespace' => 'Site', 'prefix' => 'home'], function() {
//    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'BlogController@index')->name('home.index');
    Route::get('/{id}', 'BlogController@show')->where('id', '[0-9]')->name('blog.show');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('article', 'ArticleController', ['except' => 'show']);//->name('admin.article');
    Route::post('article/deleteMultiple', 'Article@deleteAll')->name('article.deleteMultiple');
    Route::resource('categories', 'CategoriesController', ['except' => 'show']);
    Route::resource('tag', 'TagController', ['except' => 'show']);
    Route::resource('link', 'LinkController');
//    Route::group(['namespace' => 'Site'], function () {
//        Route::get('article/list/', 'ArticleController@articleList')->name('article.list');
//        Route::resource('article/', 'ArticleController', ['except' => ['show', 'index']])->name('name.resource');
//    });
});

