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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout','Auth\LoginController@logoutUser')->name('user.logout');

Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/admin', 'AdminController@index')->name('admin.home');
    Route::get('/logout','AuthAdmin\LoginController@logoutAdmin')->name('admin.logout');

    Route::get('/{path}',"AdminController@index")->where('path','([A-z\d-\/_.]+)?');
});

Route::group(['prefix' => 'instructor'], function(){
    Route::get('/login', 'AuthInstructor\LoginController@showLoginForm')->name('instructor.login');
    Route::post('/login', 'AuthInstructor\LoginController@login')->name('instructor.login.submit');
    Route::get('/instructor', 'InstructorController@index')->name('instructor.home');
    Route::get('/logout','AuthInstructor\LoginController@logoutInstructor')->name('instructor.logout');
});

Route::group(['prefix' => 'student'], function(){
    Route::get('/login', 'AuthStudent\LoginController@showLoginForm')->name('student.login');
    Route::post('/login', 'AuthStudent\LoginController@login')->name('student.login.submit');
    Route::get('/student', 'StudentController@index')->name('student.home');
    Route::get('/logout','AuthStudent\LoginController@logoutStudent')->name('student.logout');
});




