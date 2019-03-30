<?php

use App\Category;

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
Route::get('/','HomeController@index')->name('home');
Route::get('posts','PostController@index')->name('post.index');
Route::get('post/{slug}','PostController@details')->name('post.details');
Route::get('category/{slug}','PostController@postByCategory')->name('category.posts');
Route::get('tag/{slug}','PostController@postByTag')->name('tag.posts');
Route::get('search','PostController@search')->name('search');

Route::post('dashboard','SubscriberController@store')->name('subscriber.store');

Route::group(['middleware' => ['auth']], function () {
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');
    Route::post('comment/{post}', 'CommentController@store')->name('comment.store');
});
Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'Admin','middleware' => ['admin','auth']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('settings','SettingsController@index')->name('settings');
    Route::put('profile-update','SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingsController@updatePassword')->name('password.update');
    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    Route::get('pending/post', 'PostController@pending')->name('post.pending');
    Route::put('post/{id}/approve', 'PostController@approval')->name('post.approve');
    Route::get('favorite','FavoriteController@index')->name('favorite.index');
    Route::get('authors','AuthorController@index')->name('author.index');
    Route::delete('authors/{id}','AuthorController@destroy')->name('author.destroy');
    Route::get('comments','CommentController@index')->name('comment.index');
    Route::delete('comments','CommentController@destroy')->name('comment.destroy');
    Route::get('subscriber','SubscriberController@index')->name('subscribe.index');
    Route::delete('subscriber/{id}','SubscriberController@destroy')->name('subscribe.destroy');
});

Route::group(['as'=>'author.','prefix' => 'author','namespace'=>'Author','middleware' => ['author','auth']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('post', 'PostController');
    Route::get('settings','SettingsController@index')->name('settings');
    Route::put('profile-update','SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingsController@updatePassword')->name('password.update');
    Route::get('favorite','FavoriteController@index')->name('favorite.index');
    Route::get('comments','CommentController@index')->name('comment.index');
    Route::delete('comments','CommentController@destroy')->name('comment.destroy');
});


view()->composer('layouts.frontend.partial.footer', function ($view) {
    $categories = Category::all();
    $view->with('categories',$categories);
});