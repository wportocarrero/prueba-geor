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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::get('inicio','TasksController@inicio')->name('inicio');

Route::post('logueo','TasksController@logueo')->name('logueo');


Route::group(['middleware' => 'auth'], function () {
    Route::get('tasks','TasksController@getAll')->name('mostrartodo');
Route::post('agregar','TasksController@agregar')->name('agregar');
Route::post('editar/{id}','TasksController@editar')->name('editar');
Route::get('eliminar/{id}','TasksController@eliminar')->name('eliminar');
Route::get('mostrar/{id}','TasksController@mostrar')->name('mostrar');

    
});
