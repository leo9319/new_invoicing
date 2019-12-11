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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('tests','TestController');
    Route::resource('roles','RoleController');
    Route::resource('permissions','PermissionController');
    Route::resource('users','UserController');
    Route::resource('brands','BrandController');
    Route::resource('products','ProductController');
    Route::resource('inventories','InventoryController');
    Route::resource('discounts','DiscountController');
    Route::resource('vouchers','VoucherController');
    Route::resource('district-and-zones','DistrictAndZoneController');
});