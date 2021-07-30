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
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
Route::post('/home/save', 'App\Http\Controllers\HomeController@create')->name('home.create');

Route::resource('manage_users','App\Http\Controllers\ManageUsersController');
Route::post('manage_users/{id}/edit/','App\Http\Controllers\ManageUsersController@edit');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/search', 'App\Http\Controllers\SearchController@index')->name('search');
    Route::get('/manage', 'App\Http\Controllers\ManageDocumentController@index')->name('manage');
    Route::post('/manage/postSave', 'App\Http\Controllers\ManageDocumentController@create')->name('manage.create');
    Route::get('/manage/update', 'App\Http\Controllers\ManageDocumentController@update')->name('manage.update');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

