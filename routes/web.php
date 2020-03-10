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

Route::get('/', 'LoginController@index')->name('signin');
Route::post('/','LoginController@Login')->name('actionLogin');

Route::get('/register','RegisterController@index')->name('signup');
Route::post('/register','RegisterController@register')->name('actionRegister');

// Route::post('logout', 'ChatkitController@logout')->name('logout');

// Route::middleware('auth')->group(function(){

//     Route::get('/homepage', function () {
//         return view('welcome');
//     })->name('homepage');

//     route::get('/fr','ChatUserController@index')->name('index');
//     Route::get('/fr/{friendID}','ChatUserController@friendhomepage')->name('chatUser');

//     Route::post('/gr/chat/create','ChatKitController@createRoom');
//     Route::get('/gr/chat/{roomid}', 'ChatkitController@chat')->name('chat');

//     Route::get('/api/users', 'ChatUserController@getUsers');
//     Route::post('/api/message','ChatUserController@sendMessage');
// });

// test new UI
Route::get('/123', function () {
    return view('index');
})->name('homepage');

Route::get('/box-chat-group', function () {
    return view('box-chat-group');
})->name('test-1');

Route::get('/box-chat-friend', function () {
    return view('box-chat-friend');
})->name('test-2');
