<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

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

    public function register($name,$email,$password){
        if (Auth::check()) {
            exit();
        }

        $user = new  User([
            'name' => $name,
            'password' => $email,
            'email' => $password,
            'role'=>'user'
        ]);
        $user->save();
        Auth::login($user);

        return [
            'status' => true,
            'message' => 'registration was successful',
        ];

    }

    public function logInUser($name,$password){
        if (Auth::check()) {
            exit();
        }

           $user = User::where('name', '=', $name)->first();
           if($user&&$user->password==$password){
               Auth::login($user);
           }
           else
           {
               return [
                   'status' => false,
                   'message' => 'login was braked',
               ];
           }

        return [
            'status' => true,
            'message' => 'login was successful',
        ];

    }

}
