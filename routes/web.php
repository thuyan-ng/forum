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

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
*/

Route::get('/api/channels', 'ChannelsCtrl@index');
Route::get('/api/channels/{channel}', 'MessagesCtrl@show');
Route::post('/api/channels/{channel}', 'MessagesCtrl@create');
Route::delete('/api/channels/{channel}/{id}', 'MessagesCtrl@destroy');
Route::get('/api/users', 'ChatusersCtrl@index');

/*
|--------------------------------------------------------------------------
| All channels
|--------------------------------------------------------------------------
*/

Route::get('/channels', function(){
    return view('channels');
});

Route::post('/channels', 'ChannelsCtrl@create');

/*
|--------------------------------------------------------------------------
| Connexion
|--------------------------------------------------------------------------
*/

Route::get('/connexion', function(){
    return view('connexion');
});

Route::post('/connexion', 'ChatusersCtrl@create');

Route::get('/connexion/login', 'SessionCtrl@login');

Route::get('/connexion/logout', 'SessionCtrl@logout');

/*
|--------------------------------------------------------------------------
| Channel messages
|--------------------------------------------------------------------------
*/

Route::get('/channels/{channel}', 'MessagesCtrl@allMessages');