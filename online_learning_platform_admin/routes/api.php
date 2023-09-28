<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\SaveItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('course/list',[CourseController::class,'getAllCourse']);

Route::get('category/list',[CourseController::class,'getAllCategory']);

Route::post('course/',[CourseController::class,'getCourse']);

Route::post('lesson/',[CourseController::class,'getLesson'])->middleware('auth:sanctum');

Route::post('category/search/',[CourseController::class,'categorySearch']);

Route::post('post/search/',[CourseController::class,'postSearch']);

Route::post('quiz/',[CourseController::class,'viewQuiz'])->middleware('auth:sanctum');

Route::post('getStudentList',[CourseController::class,'getStudentList']);

Route::post('getCourseList',[CourseController::class,'getCourseList']);





// client Auth
Route::post('register/', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('resetPassword', [AuthController::class, 'resetPassword']);










