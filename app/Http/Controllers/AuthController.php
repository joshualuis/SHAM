<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Laravel\Sanctum\NewAccessToken;
use Redirect;
use App\Models\Student;
use App\Models\Teacher;

class AuthController extends Controller
{

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // dd($user);
        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)){ 
            return response([
                'message' => 'Bad creds'
            ], 401);
        }
        
        $token = $user->createToken('usertoken')->plainTextToken;
        // dd($token);
        // $tokens = $request->bearerToken();

        if($user->role == "teacher" || $user->role == "CARE" || 
            $user->role == "STEM"   || $user->role == "ICT" || 
            $user->role == "GAS"    || $user->role == "EIM" || 
            $user->role == "ABM"    || $user->role == "HE" || 
            $user->role == "HUMMS"   )
            {
                $role = "teacher";
            }

        else if($user->role == "student" )
            {
                $role = "student";
            }

        else
            {
                $role = "admin";
            }

        $studentID = $user->student_id;
        $teacherID = $user->teacher_id;

        if ($studentID !== null) 
            {
                $student = Student::find($studentID);
                $studentz = Student::where('lname',$student->lname)->where('fname',$student->fname)->where('mname',$student->mname)->get()->last();
                $studentID = $studentz->id;
            }

        if ($teacherID !== null) 
            {
                $teacher = Teacher::find($teacherID); 
                $teacherz = Teacher::where('lname',$teacher->lname)->where('fname',$teacher->fname)->where('mname',$teacher->mname)->get()->last();
                $teacherID = $teacherz->id;
            }

        $response =[
            'success' => true,
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $role,
            'studentID' => $studentID,
            'teacherID' => $teacherID,
            'token' => $token
            // 'tokens' => $tokens,
        ];
        
        return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
          
    }
}