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
    return view('welcome');
});

Auth::routes();

Route::resource('/profil', 'UserController')->only(["index",'edit','update'])->middleware('auth');
Route::get('/profil/{id}','UserController@otherIndex')->middleware('auth');
Route::get('/follow/{id}','UserController@follow')->middleware('auth');
Route::resource('poste', 'PosteController')->middleware('auth');
Route::post('/comment', 'PosteController@commentStore')->name('comment')->middleware('auth');
Route::get('/comment', 'PosteController@commentStore')->name('comment')->middleware('auth');
Route::get('/like/{id}','PosteController@like')->middleware('auth');
// http://localhost:8000/poste/like/2

