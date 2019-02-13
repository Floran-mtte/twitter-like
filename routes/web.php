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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/account','UserController@profile')->name('account');
Route::post('/profile','UserController@editProfile')->name('updateProfile');
Route::get('/user/{username}','UserController@displayProfile')->name('displayProfile');
Route::post('/sendTweet','PostController@sendTweet')->name('sendTweet');
Route::get('/timeline','PostController@index');
Route::get('/personal','PostController@getPersonalTweet');
Route::get('/loadFollowing','FollowController@getFollowing');
Route::get('/loadFollowers','FollowController@getFollowers');
Route::delete('/unfollow','FollowController@unfollow');
Route::post('/follow','FollowController@follow');
