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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('', 'App\Http\Controllers\HomeController@index')->middleware('auth');
Route::get('home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
Route::post('home/store', 'App\Http\Controllers\HomeController@store')->name('home.store');
Route::get('home/{id}/edit/','App\Http\Controllers\HomeController@edit');
Route::get('home/preview/{id}/', 'App\Http\Controllers\HomeController@preview');
Route::get('home/autocomplete-search', 'App\Http\Controllers\HomeController@autocompleteSearch');


Route::resource('create_users','App\Http\Controllers\CreateUsersController');
Route::post('create_users/{id}/edit/','App\Http\Controllers\CreateUsersController@edit');

Route::resource('manage_users','App\Http\Controllers\ManageUsersController');
Route::post('manage_users/{id}/edit/','App\Http\Controllers\ManageUsersController@edit');
Route::resource('manage','App\Http\Controllers\ManageDocumentController');
Route::post('manage/{id}/edit/','App\Http\Controllers\ManageDocumentController@edit');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/search', 'App\Http\Controllers\SearchController@index')->name('search');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

