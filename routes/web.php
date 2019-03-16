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

Route::get('/','HomeController@index')->name('home');

Auth::routes();

Route::post('dashboard','SubscriberController@store')->name('subscriber.store');

Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'Admin','middleware' => ['admin','auth']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    Route::get('pending/post', 'PostController@pending')->name('post.pending');
    Route::put('post/{id}/approve', 'PostController@approval')->name('post.approve');
    Route::get('subscriber','SubscriberController@index')->name('subscribe.index');
    Route::delete('subscriber/{id}','SubscriberController@destroy')->name('subscribe.destroy');
});

Route::group(['as'=>'author.','prefix' => 'author','namespace'=>'Author','middleware' => ['author','auth']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('post', 'PostController');
});
