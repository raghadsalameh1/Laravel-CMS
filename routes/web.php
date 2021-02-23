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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/blog/{post}', 'PostsController@Showblog')->name('blog');
Route::get('/blog/categories/{category}', 'PostsController@ShowblogByCategory')->name('blog.category');
Route::get('/blog/tags/{tag}', 'PostsController@ShowblogByTag')->name('blog.tag');

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('categories', 'CategoriesController');
    Route::resource('tags', 'TagsController');
    Route::resource('posts', 'PostsController');
    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');
    Route::put('restore-post/{post}', 'PostsController@restore')->name('post.restore');
    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
    //Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
    Route::put('users/profile-update', 'UsersController@update')->name('users.update-profile');
});
Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::put('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});

