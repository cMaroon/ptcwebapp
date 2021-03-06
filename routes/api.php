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

//Instructor
Route::get('search/instructorinfo/{field}/{query}','InstructorUserController@searchInfo');
Route::get('search/insturctoruser/{field}/{query}','InstructorUserController@searchUser');
Route::apiResources(['instructoruser'=>'InstructorUserController']);
Route::apiResources(['instructorinfo'=>'InstructorInfoController']);
Route::get('instructorinfolist','InstructorInfoController@instructorlist');


//Student
Route::get('search/studentinfo/{field}/{query}','StudentInformationController@searchInfo');
Route::get('search/studentuser/{field}/{query}','StudentUserController@searchUser');
Route::apiResources(['studentuser'=>'StudentUserController']);
Route::apiResources(['studentinfo'=>'StudentInformationController']);
Route::get('studentlist','StudentUserController@studentlist');

//ManageEnrollment
Route::get('search/studentenrolled/{field}/{query}','ManageEnrollmentController@searchEnroll');
Route::get('search/studentenrolledlist/{field}/{query}','ManageEnrollmentController@searchEnrollList');
Route::apiResources(['manageenrollment'=>'ManageEnrollmentController']);
Route::apiResources(['manageenrollmentcount'=>'ManageEnrollmentCountController']);
Route::get('enrolllist','ManageEnrollmentController@enrolllist');

//ManageEnrollmentAssoc
Route::get('search/assoc/{field}/{query}','ManageEnrollmentAssocController@searchAssoc');
Route::get('search/classlist/{field}/{query}','ManageEnrollmentAssocController@searchClassList');
Route::apiResources(['assoc'=>'ManageEnrollmentAssocController']);

//ManagePayment
Route::get('search/payment/{field}/{query}','ManagePaymentController@searchPayment');
Route::get('search/summarypayment/{field}/{query}','ManagePaymentController@searchPaymentList');
Route::apiResources(['managepayment'=>'ManagePaymentController']);
Route::apiResources(['manageassesstment'=>'ManageAssesstmentController']);
Route::get('paymentlist','ManagePaymentController@paymentlist');


//ManageProgram
Route::get('search/program/{field}/{query}','ManageProgramController@searchProgram');
Route::apiResources(['manageprogram'=>'ManageProgramController']);
Route::get('programlist','ManageProgramController@programlist');

//SchoolYear
Route::get('search/sy/{field}/{query}','SchoolYearController@searchSY');
Route::apiResources(['schoolyear'=>'SchoolYearController']);
Route::get('schoolyearlist','SchoolYearController@sylist');

//Semester
Route::get('search/sem/{field}/{query}','SemesterController@searchSem');
Route::apiResources(['semester'=>'SemesterController']);
Route::get('semesterlist','SemesterController@semlist');

//YearLevel
Route::get('search/yearlevel/{field}/{query}','YearLevelController@searchYearLevel');
Route::apiResources(['yearlevel'=>'YearLevelController']);
Route::get('yearlevellist','YearLevelController@yllist');

//Section
Route::get('search/section/{field}/{query}','SectionController@searchSEC');
Route::apiResources(['section'=>'SectionController']);
Route::get('sectionlist','SectionController@sectionlist');

//Courses
Route::get('search/courses/{field}/{query}','CoursesController@searchCourses');
Route::apiResources(['managecourses'=>'CoursesController']);
Route::get('courselist','CoursesController@courselist');

//Curriculum
Route::get('search/curriculum/{field}/{query}','CurriculumController@searchCurriculum');
Route::apiResources(['managecurriculum'=>'CurriculumController']);
Route::apiResources(['curriculumcount'=>'CurriculumCountController']);
Route::get('currlist','CurriculumController@currlist');

//Residency Category
Route::get('search/rc/{field}/{query}','CategoryController@searchRC');
Route::apiResources(['Category'=>'CategoryController']);
Route::get('rclist','CategoryController@rclist');

//Student Side
Route::apiResources(['myenrollment'=>'MyEnrollmentController']);