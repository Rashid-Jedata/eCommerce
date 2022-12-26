<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('categories', CategoryController::class);


//Products Route
Route::get('products/', 'ProductController@index')->name('products.index');
Route::get('products/create', 'ProductController@create')->name('products.create')->middleware('auth');
Route::post('products/store', 'ProductController@store')->name('products.store')->middleware('auth');
Route::get('products/show/{slug}', 'ProductController@show')->name('products.show');
Route::get('products/edit/{slug}', 'ProductController@edit')->name('products.edit')->middleware('auth');
Route::post('products/update/{id}', 'ProductController@update')->name('products.update')->middleware('auth');
Route::get('products/softDelete/{id}', 'ProductController@softDelete')->name('products.softDelete')->middleware('auth');
Route::get('products/HardDelete/{id}', 'ProductController@HardDelete')->name('products.HardDelete')->middleware('auth');
Route::post('products/review/{id}', 'ReviewController@store')->name('review.store');


//Shop Routes
Route::get('shop/', 'ShopController@index')->name('shop.index');



//Check Out Routes
Route::get('checkOut/{slug}', 'CheckOutController@create')->name('checkout.create');
Route::post('checkOut/{productId}', 'CheckOutController@store')->name('checkout.store');


//Favourites
Route::get('products/favourites/', 'FavouriteController@index')->name('favourite.index');
Route::post('products/favourites/store/{slug}', 'FavouriteController@store')->name('favourite.store');
Route::post('products/favourites/destroy/{slug}', 'FavouriteController@destroy')->name('favourite.destroy');


//->middleware('auth');

