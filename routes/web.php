<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LectoresController;
use App\Http\Controllers\EdicionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RevistaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CapsulaController;
use App\Http\Controllers\FlashController;
use App\Http\Controllers\SuscribeController;

use App\Mail\ContactanosMailable;
use App\Models\Suscribe;
use Illuminate\Support\Facades\Mail;

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

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// ->middleware('auth');

Route::post('suscripcion', [
	'as' => 'suscribe.store',
	'uses' => 'App\Http\Controllers\SuscribeController@suscribePost'
]);

Route::get('suscripcion', [
	'as' => 'suscribe.index',
	'uses' => 'App\Http\Controllers\SuscribeController@index'
])->middleware('auth');

// Route::resource('revistaguest', RevistaController::class);
Route::resource('revista', RevistaController::class);
Route::get('/', function () {
	return view('main.index');
});
Route::get('/nosotros', function () {
	return view('main.nosotros');
});
Route::get('/servicios', function () {
	return view('main.servicios');
});
Route::get('/contacto', function () {
	return view('main.contacto');
});

Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
Route::resource('ediciones', EdicionController::class);
Route::resource('lectores', LectoresController::class);
Route::resource('capsula', CapsulaController::class);
Route::resource('flash', FlashController::class);
Route::resource('user', UserController::class);

// Route::get('revista',['as' => 'revista.index', 'uses' => 'App\Http\Controllers\RevistaController@index'])->middleware(['guest']);

Route::group(['middleware' => 'auth'], function () {
	Route::resource('categories', CategoryController::class);
	Route::resource('posts', PostController::class);
	Route::resource('ediciones', EdicionController::class);
	Route::resource('lectores', LectoresController::class);
	Route::resource('capsula', CapsulaController::class);
	Route::resource('flash', FlashController::class);
	Route::resource('user', UserController::class);
	// Route::resource('revista', RevistaController::class);
	Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
