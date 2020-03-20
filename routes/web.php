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

// Trang Login
Route::get('/', 'LoginController@index')->name('signin')->middleware('guest');
Route::post('/','LoginController@Login')->name('actionLogin');

// Trang Register
Route::get('/register','RegisterController@index')->name('signup');
Route::post('/register','RegisterController@register')->name('actionRegister');

// Trang Logout
Route::post('logout', 'LoginController@Logout')->name('logout');

Route::middleware('auth')->group(function(){

    // Trang Index
    route::get('/homepage','ChatUserController@index')->name('index');

    // Trang chat Friends
    Route::get('/friends/{friendID}','ChatUserController@friendhomepage')->name('chatUser');

    // Trang chat Group
    Route::get('/group/{roomid}', 'ChatkitController@chat')->name('chat');
    Route::post('/group/create','ChatKitController@createRoom')->name('createroom');

    // API
    Route::get('/api/users', 'ChatUserController@getUsers');
    Route::post('/api/message','ChatUserController@sendMessage');
    Route::post('/api/delmessage', 'ChatkitController@deleteMessage');

    // ROUTE USE FOR TEST
    // Route::get('api/test', 'ChatkitController@getUserJoinRoom');
    // Route::get('/test', function () {
    //     return view('test');
    // })->name('test');
});

