<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Mail\HelloMail;
use App\Models\student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:students,email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }


        $user = new student;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Registration is completed'
            ]
        );
    }

     // login relese token
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('students')->attempt($credentials)) {

            $student = Auth::guard('students')->user();
            if ($student) {
                try {
                    $token = $student->createToken('Token Name', ['student:read', 'student:write'])->plainTextToken;
                    return response([
                        'token' => $token,
                        'data' => $student,
                    ]);
                } catch (\Exception $e) {
                    return response(['errors' => [$e->getMessage()]], 500);
                }
            } else {
                return response(['errors' => ['Unable to create token for user']], 500);
            }
        } else {
            return response(['errors' => ['Invalid email or password']], 401);
        }

    }

    //
       public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response(['message' => 'Successfully logged out']);
    }

    //
   public function forgotPassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255'
    ]);

    if ($validator->fails()) {
        return response(['errors' => $validator->errors()->all()], 422);
    }

    $user = student::where('email', $request->email)->first();

    if (!$user) {
        return response(['errors' => ['Email not found']], 404);
    }

    $token = Str::random(60);
    $user->reset_password_token = $token;
    $user->reset_password_sent_at = now();
    $user->save();

    $resetLink = 'http://localhost:8080/resetPassword?token=' . $token;

    Mail::to($request->email)->send(new HelloMail($resetLink));

    return response(['message' =>'Reset password email sent'], 200);

}

//
public function resetPassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'token' => 'required',
        'email' => 'required|string|email|max:255' ,
        'password' => 'required|string|min:8' ,
        'password_comfirmation' => 'required|string|min:8|same:password'
    ]);

    if ($validator->fails()) {
        return response(['errors' => $validator->errors()->all()], 422);
    }

    $user = student::where('email', $request->email)->first();

    if (!$user) {
        return response(['errors' => ['Email not found']], 404);
    }

    if ($user->reset_password_token !== $request->token) {
        return response(['errors' => ['Invalid reset password token']], 400);
    }

    if (Carbon::parse($user->reset_password_sent_at)->addMinutes(60)->isPast()) {
        return response(['errors' => ['Reset password token has expired']], 400);
    }

    $user->password = Hash::make($request->password);
    $user->reset_password_token = null;
    $user->reset_password_sent_at = null;
    $user->save();

    return response(['message' => 'Password reset successfully'], 200);
}



}
