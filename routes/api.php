<?php

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//AUTHENTICATION
Route::post('/register', 'Auth\RegisterController@register')->name('auth.register');
Route::post('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/logout', 'Auth\LoginController@logout')->middleware('auth:sanctum')->name('auth.logout');

//EMAIL
//Route::get('/email', function () {
//    return new WelcomeMail();
//});

//POSTS
Route::get('/posts', 'PostController@index')->name('post.index')->middleware('auth:sanctum');
Route::post('/post', 'PostController@store')->name('post.store')->middleware('auth:sanctum');
Route::patch('/post/{post}', 'PostController@update')->name('post.update')->middleware('auth:sanctum');
Route::get('/post/{post}', 'PostController@show')->name('post.show')->middleware('auth:sanctum');
Route::delete('/post/{post}', 'PostController@delete')->name('post.delete')->middleware('auth:sanctum');

//COMMENTS
Route::post('/comment/{post}', 'CommentController@store')->name('comment.store')
    ->middleware('auth:sanctum');
Route::get('/comment/{comment}', 'CommentController@show')->name('comment.show')
    ->middleware('auth:sanctum');
Route::get('/comments', 'CommentController@index')->name('comment.index')
    ->middleware('auth:sanctum');
Route::patch('/comment/{comment}', 'CommentController@update')->name('comment.update')
    ->middleware('auth:sanctum');
Route::delete('/comment/{comment}', 'CommentController@delete')->name('comment.delete')
    ->middleware('auth:sanctum');

//POSTS
Route::post('/like/{post}', 'LikeController@store')->name('like.store')
    ->middleware('auth:sanctum');
Route::get('/likes', 'LikeController@index')->name('like.show')
    ->middleware('auth:sanctum');
Route::delete('/like/{like}', 'LikeController@delete')->name('like.delete')
    ->middleware('auth:sanctum');

//EVENTS
Route::get('/events', 'EventsController@index')->middleware('auth:sanctum');
Route::get('/event/{id}', 'EventsController@show')->middleware('auth:sanctum');
Route::post('/event', 'EventsController@store')->middleware('auth:sanctum');
Route::patch('/event/{id}', 'EventsController@update')->middleware('auth:sanctum');
Route::delete('/event/{id}', 'EventsController@delete')->middleware('auth:sanctum');
