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

Route::get('/fr/register','RegisterController@index')->name('register');
Route::post('/fr/register','RegisterController@register')->name('actionregister');

Route::middleware('auth')->group(function(){

    Route::get('/fr/Homepage','ChatUserController@friendhomepage')->name('chatUser');
    // Route::post('/fr/Homepage','ChatUserController@createRoom');
    Route::get('/fr/{friendID}','ChatUserController@createRoom')->name('chatFriend');

    Route::get('api/users', 'ChatUserController@getUsers');
    Route::post('api/message','ChatUserController@sendMessage');
    Route::get('/fr/chat', 'ChatUserController@chat')->name('chatuserabc');
});

Route::get('/', 'ChatkitController@index');
Route::post('/', 'ChatkitController@join');
Route::get('chat/{roomid}', 'ChatkitController@chat')->name('chat');
Route::post('logout', 'ChatkitController@logout')->name('logout');
Route::post('/api/message','ChatkitController@sendMessage');
