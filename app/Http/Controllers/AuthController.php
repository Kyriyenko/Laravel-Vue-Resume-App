<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        if (Auth::check()) {
            exit();
        }

        $uniqueUser=User::where('name', '=', $request->name)->first();
        if($uniqueUser){
            return [
                'unique' => 'null',
                'message' => 'this name is already taken',
            ];
        }

        $user=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ];

        $validator = Validator::make($user, [
            'email' => 'required|email',
            'name' => 'required|string|max:50',
            'password' => 'required|min:4'
        ]);

        if ($validator->fails()) {
            return [
                'status'=>false,
                'errors'=>  $validator->messages()
            ];
        }
        else
        {
            $user = new  User([
                'name'=>$request->name,
                'password'=>$request->password,
                'email'=>$request->email,
                'role'=>'user'
            ]);
            $user->save();
            Auth::login($user);
        }

        return [
            'status' => true,
            'message' => 'registration was successful',
        ];
    }


    public function loginUser(Request $request){
        if (Auth::check()) {
            exit();
        }

        $visitor=[
            'name'=>$request->name,
            'password'=>$request->password
        ];

        $validator = Validator::make($visitor, [
            'name' => 'required|string|max:50',
            'password' => 'required|min:4'
        ]);

        if ($validator->fails()) {
            return [
                'status'=>'braked',
                'errors'=>  $validator->messages()
            ];
        }

        $user = User::where('name', '=', $request->name)->first();
        if($user&&$user->password==$request->password){
            Auth::login($user);
        }
        else
        {
            return [
                'status' => 'null',
                'message' => 'wrong email or password',
            ];
        }

        return [
            'status' => 'login',
            'message' => 'login was successful',
        ];

    }

    public function getUserStatus(){
        if(Auth::check()) {
           $user = Auth::user();
           return $user['role'];
        }

        return 'guest';
    }

    public function logOutUser(){
        if (Auth::check()) {
            Auth::logout();
        }

        return 'guest';
    }

}
