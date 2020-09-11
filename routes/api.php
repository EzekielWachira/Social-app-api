<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//AUTHENTICATION
Route::post('/register', 'Auth\RegisterController@register')->name('auth.register');
Route::post('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/logout', 'Auth\LoginController@logout')->middleware('auth:sanctum')->name('auth.logout');

//POSTS
Route::get('/posts', 'PostController@index')->name('post.index')->middleware('auth:sanctum');
Route::post('/post', 'PostController@store')->name('post.store')->middleware('auth:sanctum');
Route::patch('/post/{post}', 'PostController@update')->name('post.update')->middleware('auth:sanctum');
Route::get('/post/{post}', 'PostController@show')->name('post.show')->middleware('auth:sanctum');
Route::delete('/post/{post}', 'PostController@delete')->name('post.delete')->middleware('auth:sanctum');