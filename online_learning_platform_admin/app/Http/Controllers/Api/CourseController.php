<?php

namespace App\Http\Controllers\Api;

use App\Models\quiz;
use App\Models\lesson;
use App\Models\student;
use App\Models\category;
use App\Models\lesson_video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    // Get All Course
    public function getAllCourse(){
        $data = lesson::select('lessons.*','categories.category_name as category_name')
        ->leftjoin('categories','lessons.category_id','categories.id')
        ->get();

        return response()->json([
            'status' => 'success',
            'getAllCourse' => $data,
        ]);
    }

    // Get All Category
    public function getAllCategory(){
        $data = category::select('category_name')->get();

          return response()->json([
            'status' => 'success',
            'getAllCategory' => $data,
        ]);
    }

    // Get All Lesson
    public function getCourse(Request $request){
        $id =$request->course_id;

        $course_data = lesson::where('id' , $id)->first();

        return response()->json([
            'status' => 'success',
            'getCourse' => $course_data,
        ]);
    }

    // Get lesson
    public function getLesson(Request $request){
        $id =$request->lesson_id;

        $lesson_data = lesson_video::select('lesson_videos.*','lessons.name as lesson_name')
        ->leftjoin('lessons','lesson_videos.lesson_id','lessons.id')
        ->where('lesson_id' , $id)->get();

        return response()->json([
            'status' => 'success',
            'getAllLesson' => $lesson_data,
        ]);
    }

    //category search
     public function categorySearch(Request $request){
        $lessonData = lesson::select('lessons.*','categories.category_name as category_name')
        ->leftjoin('categories','lessons.category_id','categories.id')
        ->where('name','like','%'.$request->key.'%')->get();

        return response()->json([
            'status' => 'success',
            'data' => $lessonData,
        ]);
    }

    // post search
    public function postSearch(Request $request){
        $data = category::select('lessons.*','categories.category_name as category_name')
        ->join('lessons','lessons.category_id','categories.id')
        ->where('categories.category_name','like','%'.$request->key.'%')->get();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    // Get all quiz
    public function viewQuiz(Request $request){
         $id =$request->quiz_id;

        $data = quiz::where('lesson_id',$id)->get();

        return response()->json([
            'status' => 'success',
            'getAllQuiz' => $data,
        ]);
    }

    //Get student List
    public function getStudentList(){
        $count = student::count();

        return response()->json([
            'status' => 'success',
            'getStudentList' => $count,
        ]);
    }


    //Get course List
    public function getCourseList(){
        $count = lesson::count();

        return response()->json([
            'status' => 'success',
            'getCourseList' => $count,
        ]);
    }
}
