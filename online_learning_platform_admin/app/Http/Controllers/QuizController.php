<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use App\Models\lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    // view
    public function manageQuiz(){
        $courseData = lesson::all();

        return view('admin.quiz.view',compact('courseData'));
    }

    // add quiz
    public function addQuiz(Request $request){
        // dd($request->all());
        $this->quizCreateValidation($request);

        $data = $this->getQuizData($request);

        quiz::create($data);

        return back()->with('success' , 'Quiz Successfully Added ...!');
    }

    // view
    public function viewQuiz(){
        $data = quiz::select('quizzes.*','lessons.name as course_name')
        ->leftjoin('lessons','lessons.id','quizzes.lesson_id')
        ->paginate(10);

        return view('admin.quiz.viewQuiz',compact('data'));
    }

    // search Quiz
    public function searchQuiz(Request $request){
    $data = quiz::select('quizzes.*','lessons.name as course_name')
                        ->leftjoin('lessons','lessons.id','quizzes.lesson_id')
                        ->orwhere('question','like','%'.$request->quizSearchKey.'%')
                        ->orwhere('lessons.name','like','%'.$request->quizSearchKey.'%')
                        ->paginate(10);
            return view('admin.quiz.viewQuiz', compact('data'));

    }

    //delete
    public function deleteQuiz($id){
        quiz::where('id' , $id)->delete();

        return back()->with('deleted' , 'Quiz Successfully Deleted ...!');
    }

    // Edit
    public function editQuiz($id){
        $data = quiz::select('quizzes.*','lessons.name as course_name')
                        ->leftjoin('lessons','lessons.id','quizzes.lesson_id')
                        ->where('quizzes.id' , $id)->first();
        return view('admin.quiz.edit' , compact('data'));
    }

    // update
    public function updateQuiz(Request $request,$id){
        $this->quizCreateValidation($request);
        $data =$this->getQuizData($request);
        quiz::where('id',$id)->update($data);
        return redirect()->route('admin#viewQuiz')->with('success' , 'Quiz Successfully Updated .. !');
    }

    // quiz data
     private function getQuizData($request){
        return [
            'lesson_id' => $request->course_name ,
            'question' => $request->quiz_question ,
            'option_1' => $request->opt_1 ,
            'option_2' => $request->opt_2 ,
            'option_3' => $request->opt_3 ,
            'option_4' => $request->opt_4 ,
            'answer' => $request->correct_answer ,
        ];
    }

    // quiz validation
    private function quizCreateValidation($request){
        Validator::make($request->all(), [
            'course_name' => 'required',
            'quiz_question' => 'required',
            "opt_1" => 'required',
            "opt_2" => 'required',
            "opt_3" => 'required',
            "opt_4" => 'required',
            "correct_answer" => 'required',
        ])->validate();
    }

}
