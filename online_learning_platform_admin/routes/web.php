<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LessonVideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/register', function () {
    return view('auth/register');
})->name('register');

//
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [UserController::class,'dashboard'])->name('dashboard');

    // admin lists
    Route::get('admin/List',[UserController::class,'adminList'])->name('admin#adminList');
    Route::get('/admin/delete/{id}',[UserController::class,'adminDelete'])->name('admin#adminDelete');
    Route::get('/admin/search',[UserController::class,'adminSearch'])->name('admin#adminSearch');

    // lesson cate
    Route::get('/lesson/category',[CategoryController::class,'lessonCategory'])->name('admin#lessonCategory');
    Route::post('add/category',[CategoryController::class,'addCategory'])->name('admin#addCategory');
    Route::get('delete/category/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
    Route::post('add/category/{id}',[CategoryController::class,'updateCategory'])->name('admin#updateCategory');
    Route::get('/category/search',[CategoryController::class,'categorySearch'])->name('admin#categorySearch');

    // create course
    Route::get('/create/course/',[LessonController::class,'createCourse'])->name('admin#createCourse');
    Route::post('/create/course/',[LessonController::class,'createNewCourse'])->name('admin#createNewCourse');
    Route::get('/view/course/',[LessonController::class,'viewCourse'])->name('admin#viewCourse');
    Route::get('/edit/course/',[LessonController::class,'editCourse'])->name('admin#editCourse');
    Route::get('/delete/course/{id}',[LessonController::class,'deleteCourse'])->name('admin#deleteCourse');
    Route::get('/update/course/{id}',[LessonController::class,'updateCourse'])->name('admin#updateCourse');
    Route::post('/update/course/',[LessonController::class,'updateCreatedCourse'])->name('admin#updateCreatedCourse');
    Route::get('/course/search',[LessonController::class,'courseSearch'])->name('admin#courseSearch');
    Route::get('/list/search',[LessonController::class,'listSearch'])->name('admin#listSearch');


    //create lesson
    Route::get('/create/lesson/{id}',[LessonVideoController::class,'createLesson'])->name('admin#createLesson');
    Route::post('/create/lesson/',[LessonVideoController::class,'uploadLesson'])->name('admin#uploadLesson');
    Route::get('/view/lesson/{id}',[LessonVideoController::class,'viewLesson'])->name('admin#viewLesson');
    Route::get('/course/{id}',[LessonVideoController::class,'viewLessonCourse'])->name('admin#viewLessonCourse');
    Route::get('get-video/{video}', [LessonVideoController::class,'getVideo'])->name('admin#getVideo');
    Route::get('delete/lesson/{id}',[LessonVideoController::class,'deleteLesson'])->name('admin#deleteLesson');
    Route::get('edit/lesson/{id}',[LessonVideoController::class,'editLesson'])->name('admin#editLesson');
    Route::post('edit/lesson/',[LessonVideoController::class,'updateLesson'])->name('admin#updateLesson');

    // Quiz Managemeent
    Route::get('manage/quiz',[QuizController::class,'manageQuiz'])->name('admin#manageQuiz');
    Route::post('add/quiz',[QuizController::class,'addQuiz'])->name('admin#addQuiz');
    Route::get('view/quiz',[QuizController::class,'viewQuiz'])->name('admin#viewQuiz');
    Route::get('search/quiz',[QuizController::class,'searchQuiz'])->name('admin#searchQuiz');
    Route::get('delete/quiz/{id}',[QuizController::class,'deleteQuiz'])->name('admin#deleteQuiz');
    Route::get('edit/quiz/{id}',[QuizController::class,'editQuiz'])->name('admin#editQuiz');
    Route::post('update/quiz/{id}',[QuizController::class,'updateQuiz'])->name('admin#updateQuiz');

});
