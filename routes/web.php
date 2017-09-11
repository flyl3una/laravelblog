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
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/{id}', 'HomeController@show')->where('id', '[0-9]*')->name('home.show');
    Route::get('/archive/{select_year?}', 'HomeController@archive')->name('home.archive');
    Route::get('/category/{id?}', 'HomeController@category')->name('home.category');
    Route::post('/search/', 'HomeController@search')->name('home.search');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::get('/user/{id}', 'AdminController@user')->name('admin.user');



    Route::post('article/moveToTrash', 'ArticleController@moveToTrash')->name('article.moveToTrash');
    Route::get('article/published', 'ArticleController@published')->name('article.published');
    Route::get('article/draft', 'ArticleController@draft')->name('article.draft');
    Route::resource('article', 'ArticleController');

    Route::post('categories/deleteMultiple', 'CategoriesController@deleteMultiple')->name('categories.deleteMultiple');
    Route::resource('categories', 'CategoriesController', ['except' => 'show']);


//    Route::resource('page', 'PageController', ['except' => 'edit']);

    Route::resource('media', 'MediaController');
//    Route::get('media/picture', 'MediaController@pictureIndex')->name('media.picture.index');
//    Route::get('media/video', 'MediaController@videoIndex')->name('media.video.index');
//    Route::get('media/audio', 'MediaController@audioIndex')->name('media.audio.index');
    Route::post('tag/deleteMultiple', 'TagController@deleteMultiple')->name('tag.deleteMultiple');
    Route::resource('tag', 'TagController', ['except' => 'show']);

    Route::post('link/deleteMultiple', 'LinkController@deleteMultiple')->name('link.deleteMultiple');
    Route::resource('link', 'LinkController');
//    Route::group(['namespace' => 'Site'], function () {
//        Route::get('article/list/', 'ArticleController@articleList')->name('article.list');
//        Route::resource('article/', 'ArticleController', ['except' => ['show', 'index']])->name('name.resource');
//    });
});

