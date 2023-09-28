<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //  Viw dashboard
    public function dashboard(){
        return view('admin.home');
    }

    // admin list
    public function adminList(){
        $user=User::get();
        return view('admin.adminList',compact('user'));
    }

    // admin delete
    public function adminDelete($id){
        User::where('id' , $id)->delete();
        return back()->with('status','Account Deleted !');
    }

    // admin search
    public function adminSearch(Request $request){
        $user = User::orwhere('name','like','%'.$request->adminSearchKey.'%')
                    ->orwhere('email','like','%'.$request->adminSearchKey.'%')
                    ->orwhere('phone','like','%'.$request->adminSearchKey.'%')
                    ->orwhere('address','like','%'.$request->adminSearchKey.'%')
                    ->orwhere('gender','like','%'.$request->adminSearchKey.'%')
                    ->get();
                    return view('admin.adminList', compact('user'));

    }
}
