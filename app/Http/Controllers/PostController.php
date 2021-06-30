<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function showPost(){
        $post = Post::all();
        response()->json($post, 200)->send();
    }

    public function updatePost(Request $request){
        if (!Auth::check()) {
            exit();
        }

        $user = Auth::user();
        $role=$user['role'];

        if($role!=='admin'){
            return [
                'status' => false,
                'message' => 'You do not have access to this doing',
            ];
        }

        $post = Post::find($request->id);
        $post->name=$request->name;
        $post->email=$request->email;
        $post->network=$request->network;
        $post->number=$request->number;
        $post->education=$request->education;
        $post->skills=$request->skills;
        $post->profile=$request->profile;
        $post->experience=$request->experience;
        $post->save();

        return [
            'status' => true,
            'message' => 'post was updated',
            'record'=> $post->toArray()
        ];
    }

}
