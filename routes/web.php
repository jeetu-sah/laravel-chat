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

Route::prefix('chat')->group(function () {
    Route::post('/send-msg', 'HomeController@sendMsg');
    Route::post('/user-list', 'HomeController@userList')->name('home');
    Route::post('/active-user-chats', 'HomeController@activeUserChats');
    Route::post('/chat-user-list', 'HomeController@chatUserList')->name('home');
    Route::post('/create-channel', 'HomeController@createChannel');
});

