<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    //
    public function lessonCategory(){
        $categoryData =category::paginate(5);
        return view('admin.lessonCategory',compact('categoryData'));
    }

    //
    public function addCategory(Request $request){
        $data =$this->getCategoryData($request);
        $categoryData = category::create($data);
        return redirect()->route('admin#lessonCategory');
    }

    //
    public function deleteCategory($id){
        category::where('id',$id)->delete();
        return back()->with(['delete' => 'Category Deleted !']);
    }

    //
    public function updateCategory(Request $request,$id){
        $this->categoryValidation($request);
        $data =$this->getCategoryData($request);
        category::where('id',$id)->update($data);
        return redirect()->route('admin#lessonCategory');
    }

    //cate search
    public function categorySearch(Request $request){
        $categoryData = category::where('category_name','like','%'.$request->categorySearchKey.'%')
                    ->paginate(5);
                    return view('admin.lessonCategory', compact('categoryData'));
    }

    // category validation
    private function categoryValidation($request){
        Validator::make($request->all(), [
            'category_name' => 'required|unique:categories,category_name,'.$request->id,
            'category_description' => 'required',
        ])->validate();
    }

    // category data
    private function getCategoryData($request){
        return [
            'category_name' => $request->category_name ,
            'category_description' => $request->category_description ,
        ];
    }
}
