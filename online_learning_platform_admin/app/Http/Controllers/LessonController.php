<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use App\Models\lesson;
use App\Models\category;
use App\Models\lesson_video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    //
    public function createCourse(){
        $categoryData =category::get();
        return view('admin.createCourse',compact('categoryData'));
    }
    //search
    public function courseSearch(Request $request){
         $lessonData =lesson::select('lessons.*','categories.category_name as category_name')
        ->leftjoin('categories','lessons.category_id','categories.id')
                    ->orwhere('name','like','%'.$request->courseSearchKey.'%')
                    ->orwhere('categories.category_name','like','%'.$request->courseSearchKey.'%')
        ->paginate(3);
        return view('admin.viewCourse',compact('lessonData'));
    }

    //view course
    public function viewCourse(){
        $lessonData =lesson::select('lessons.*','categories.category_name as category_name')
        ->leftjoin('categories','lessons.category_id','categories.id')
        ->paginate(3);
        return view('admin.viewCourse',compact('lessonData'));
    }

    //delete course
    public function deleteCourse($id){
        $img =lesson::where('id',$id)->first();
        Storage::disk('public')->delete('web_img/'.$img->image);


        $videoData = lesson_video::where('lesson_id',$id)->get();
        foreach ($videoData as $item) {
            Storage::disk('public')->delete('videos/'.$item->file_name);
        };



        lesson::where('id',$id)->delete();

        lesson_video::where('lesson_id',$id)->delete();

        quiz::where('lesson_id',$id)->delete();


        return back()->with(['deleted' => 'Course Successfully Deleted ...!']);
    }

    //update course
    public function updateCourse($id){
        $categoryData = category::get();
        $courseData = lesson::where('id',$id)->first();
        $lessonVideo= lesson_video::where('lesson_id',$id)->get();
        return view('admin.updateCourse',compact('courseData','categoryData','lessonVideo'));
    }


    //edit course
    public function editCourse(){
        $courseData =lesson::select('lessons.*','categories.category_name as category_name')
        ->leftjoin('categories','lessons.category_id','categories.id')
        ->paginate(5);
        return view('admin.manageCourse',compact('courseData'));
    }

    //searcg
    public function listSearch(Request $request){
        $courseData =lesson::select('lessons.*','categories.category_name as category_name')
        ->leftjoin('categories','lessons.category_id','categories.id')
        ->orwhere('name','like','%'.$request->adminSearchKey.'%')
        ->orwhere('category_name','like','%'.$request->adminSearchKey.'%')
        ->paginate(5);
        return view('admin.manageCourse',compact('courseData'));

    }

    //
    public function createNewCourse(Request $request){
        $this->newCourseValidation($request,'createNewCourse');
        $data = $this->newCourseData($request);

        $fileName = uniqid().$request->file('course_img')->getClientOriginalName();
        $request->file('course_img')->storeAs('public/web_img', $fileName);
        $data['image'] = $fileName;

        lesson::create($data);
        return back()->with(['success' => 'Lesson successfully created ...']);
    }

    // update create course
    public function updateCreatedCourse(Request $request){
        $this->newCourseValidation($request,'updateCreatedCourse');
        $data =$this->newCourseData($request);

        if($request->hasFile('course_img')){
            $oldImage=lesson::where('id',$request->course_Id)->first();
            $oldImage =$oldImage->image;

            if($oldImage != null){
                Storage::delete('public/web_img'.$oldImage);
            }
            $fileName = uniqid() . $request->file('course_img')->getClientOriginalName();
            $request->file('course_img')->storeAs('public/web_img',$fileName);
            $data['image'] = $fileName;
        }
        lesson::where('id',$request->course_Id)->update($data);
        return back()->with(['updated' => 'Updated ...!']);
    }

    // lesson data
    private function newCourseData($request){
        return [
            'name' => $request->course_name ,
            'category_id' => $request->category_id ,
            'content' => $request->course_description ,
        ];
    }

    // lesson validation
     private function newCourseValidation($request,$action){
        $validationRule =[
            'course_name' => 'required',
            'category_id' => 'required',
            'course_description' => 'required',
        ];
        $validationRule ['course_img'] =$action == 'createNewCourse' ? 'required|mimes:png,jpg,jpeg.webp|file':'mimes:png,jpg,jpeg.webp|file';
       Validator::make($request->all(),$validationRule )->validate();
    }
}
