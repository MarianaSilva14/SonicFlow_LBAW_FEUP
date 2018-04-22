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

Route::get('/', function () {
    return redirect('homepage');
});

// Profile
Route::get('users/{id}','CustomerController@show')->name('profile');
Route::post('users/{id}','CustomerController@update');
Route::get('users/{id}/edit','CustomerController@edit')->name('profileEdit');
Route::post('/users/favorites/{sku}','CustomerController@addToFavoritesList')->name('addFavoritesList');
Route::delete('/users/favorites/{sku}','CustomerController@removeFromFavoritesList')->name('removeFromFavoritesList');

// Products
Route::view('products','pages.homepage')->name('products');

//Single Product
Route::get('product/{id}/edit','ProductController@editForm')->where('id','[0-9]+')->name('product_edit');
Route::post('product/{id}/comment','ProductController@addComment')->where('id','[0-9]+')->name('product_comment');
Route::get('product/{id}','ProductController@show')->where('id','[0-9]+')->name('product');
Route::post('product/{id}','ProductController@update')->where('id','[0-9]+');
Route::delete('product/{id}','ProductController@show')->where('id','[0-9]+');
Route::get('product/create','ProductController@create')->name('product_create');
Route::post('product/','ProductController@show')->name('product_add');

// Static
Route::view('homepage','pages.homepage')->name('homepage');
Route::view('about','pages.about')->name('about');
Route::view('contact','pages.contact')->name('contact');
Route::view('faq','pages.faq')->name('faq');
Route::view('configurator','pages.homepage')->name('configurator');
Route::view('shoppingCart','pages.homepage')->name('shoppingCart');


// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Administration
Route::get('administration', 'AdministratorController@show')->name('administration');

// Moderation
Route::get('moderation', 'ModeratorController@show')->name('moderation');

// API new
Route::get('api/product/{sku}', 'ProductController@getProductBySku')->where('sku', '[0-9]+')->name('api_product_sku');
Route::get('api/product/{name}', 'ProductController@getProductsByName')->name('api_product_name');
Route::get('api/discounts', 'ProductController@getDiscounted')->name('api_discounted');
Route::get('api/products/', 'ProductController@getProducts')->name('api_products');

Route::get('', function () {
    return redirect('login');
});
