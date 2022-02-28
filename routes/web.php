<?php

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

Route::post('/broadcasting/auth', 'BroadCastingController')->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'MainController@index');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/chat/send-msg', 'HomeController@sendMsg');
Route::post('/chat/user-list', 'HomeController@userList')->name('home');
Route::post('/chat/active-user-chats', 'HomeController@activeUserChats');

Route::post('/chat/chat-user-list', 'HomeController@chatUserList')->name('home');

Route::post('/chat/create-channel', 'HomeController@createChannel');
