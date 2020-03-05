<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/users/get-all-users', 'UserController@getAllUsers');
Route::post('/users/store', 'UserController@store');
Route::put('/users/{user}', 'UserController@update');
Route::delete('/users/{user}', 'UserController@destroy');

Route::get('/roles/get-all-roles', 'RoleController@getAllRoles');

Route::get('/test', 'TestController@test');
Route::put('/test/{test}', 'TestController@update');
Route::delete('/test/{test}', 'TestController@destroy');
