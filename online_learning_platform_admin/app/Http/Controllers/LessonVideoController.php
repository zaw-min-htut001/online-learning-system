<?php

namespace App\Http\Controllers;

use App\Models\lesson;
use App\Models\lesson_video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class LessonVideoController extends Controller
{
    //
    public function createLesson($id){
        $course_name =lesson::where('id',$id)->select('name','id')->first();
        return view('admin.video_course.lessonVideo')->with('course_name' , $course_name);
    }

    //view lesson
    public function viewLesson($id){
        $data = lesson::where('id',$id)->first();
        $video_data = lesson_video::where('lesson_id',$id)->paginate();
        return view('admin.video_course.view',compact('video_data'))->with('data' , $data);
    }

    //
    public function viewLessonCourse($id){
        $video_data = lesson_video::where('lesson_id',$id)->get();
        $video = lesson_video::where('lesson_id',$id)->paginate(1);
        return view('admin.video_course.viewLesson',compact('video_data','video'));
    }

    // Retrieve video
    public function getVideo($video)
    {
        $name = $video;
        $fileContents = Storage::disk('public')->get("videos/{$name}");
        $response = Response::make($fileContents, 200);
        $response->header('Content-Type', "video/mp4");
        return $response;
    }
    //
    public function uploadLesson(Request $request){
        $this->videoLessonValidation($request,'createNewLesson');

        $data = $this->lessonData($request);

        $fileName =  uniqid().$request->lesson_video->getClientOriginalName();
        $filePath = 'videos/' . $fileName;
        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->lesson_video));

        if ($isFileUploaded) {

            $data['file_name'] = $fileName;
            $data['lesson_id'] = $request->lesson_id;
            lesson_video::create($data);

            return back()
            ->with('success','Video has been successfully uploaded.');
        }
    }

    // lesson Delete
    public function deleteLesson($id){
        $video= lesson_video::where('id',$id)->get();

        Storage::disk('public')->delete('videos/'.$video[0]['file_name']);

        lesson_video::where('id', $id )->delete();

        return back()->with('deleted' , 'Lesson Successfully Deleted ... !');
    }

    // Edit lesson
    public function editLesson($id){
         $videoData= lesson_video::where('id',$id)->first();
        return view('admin.video_course.editLesson',compact('videoData'));
    }

    //  Update Lesson
    public function updateLesson(Request $request){
        $this->videoLessonValidation($request,'updateLesson');

        $data = $this->lessonData($request);

        if($request->hasFile('lesson_video')){
            $video= lesson_video::where('id',$request->lesson_id)->first();

            Storage::disk('public')->delete('videos/'.$video->file_name);

            $fileName =  uniqid().$request->lesson_video->getClientOriginalName();
            $filePath = 'videos/' . $fileName;
            $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->lesson_video));

            if ($isFileUploaded) {
                $data['file_name'] =$fileName;

            }
        }
            lesson_video::where('id',$request->lesson_id)->update($data);

        return back()->with(['updated' => 'Updated ...!']);
    }
    // lesson data
    private function lessonData($request){
        return [
            'name' => $request->lesson_name ,
        ];
    }

    // Validation Check
    private function videoLessonValidation($request,$action){
        $validationRule =[
            'lesson_name' => 'required',
        ];
        $validationRule ['lesson_video'] =$action == 'createNewLesson' ? 'required|file|mimetypes:video/mp4':'file|mimetypes:video/mp4';
        Validator::make($request->all(),$validationRule )->validate();
    }

}
