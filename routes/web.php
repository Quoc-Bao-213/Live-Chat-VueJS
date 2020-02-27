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

Route::get('/fr/login', 'LoginController@index')->name('login')->middleware('guest');
Route::post('/fr/login','LoginController@Login')->name('xu-ly-dang-nhap');

Route::middleware('auth')->group(function(){

    Route::get('/fr/Homepage', function () {
        return view('chatUser');
    })->name('chatUser');

});

Route::get('/', 'ChatkitController@index');
Route::post('/', 'ChatkitController@join');
Route::get('chat/{roomid}', 'ChatkitController@chat')->name('chat');
Route::post('logout', 'ChatkitController@logout')->name('logout');
Route::post('/api/message','ChatkitController@sendMessage');
