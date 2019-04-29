<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Admin
Route::get('search/admininfo/{field}/{query}','AdminUserController@searchInfo');
Route::get('search/adminuser/{field}/{query}','AdminUserController@searchUser');
Route::apiResources(['adminuser'=>'AdminUserController']);
Route::apiResources(['admininfo'=>'AdminInfoController']);

//Student
Route::get('search/studentinfo/{field}/{query}','StudentUserController@searchInfo');
Route::get('search/studentuser/{field}/{query}','StudentUserController@searchUser');
Route::apiResources(['studentuser'=>'StudentUserController']);
Route::apiResources(['studentinfo'=>'StudentInfoController']);

//ManageEnrollment
Route::get('search/studentenrolled/{field}/{query}','ManageEnrollmentController@searchEnroll');
Route::apiResources(['manageenrollment'=>'ManageEnrollmentController']);

//ManageProgram
Route::get('search/program/{field}/{query}','ManageProgramController@searchProgram');
Route::apiResources(['manageprogram'=>'ManageProgramController']);