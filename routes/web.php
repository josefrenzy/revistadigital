<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LectoresController;
use App\Http\Controllers\EdicionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RevistaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CapsulaController;
use App\Http\Controllers\FlashController;
use App\Http\Controllers\PublicidadController;


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

Route::get('/', [
	'as' => 'index',
	'uses' => 'App\Http\Controllers\RevistaController@index'
]);

Auth::routes();

Route::post('suscripcion', [
	'as' => 'suscribe.store',
	'uses' => 'App\Http\Controllers\SuscribeController@suscribePost'
]);

Route::get('suscripcion', [
	'as' => 'suscribe.index',
	'uses' => 'App\Http\Controllers\SuscribeController@index'
])->middleware('auth');

Route::delete('suscripcion/{id}', [
	'as' => 'suscribe.destroy',
	'uses' => 'App\Http\Controllers\SuscribeController@destroy'
])->middleware('auth');

Route::resource('revista', RevistaController::class);

Route::get('/search/', 'App\Http\Controllers\PostController@search')->name('search');

Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
Route::resource('ediciones', EdicionController::class);
Route::resource('lectores', LectoresController::class);
Route::resource('capsula', CapsulaController::class);
Route::resource('flash', FlashController::class);
Route::resource('user', CapsulaController::class);
Route::resource('ediciones', EdicionController::class);
Route::resource('publicidad', PublicidadController::class);

Route::group(['middleware' => 'auth'], function () {
	Route::resource('categories', CategoryController::class)->except(['show']);
	Route::resource('posts', PostController::class);
	Route::resource('ediciones', EdicionController::class)->except(['show']);
	Route::resource('lectores', LectoresController::class);
	Route::resource('capsula', CapsulaController::class)->except(['show']);
	Route::resource('flash', FlashController::class)->except(['show']);
	Route::resource('user', UserController::class);
	Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
