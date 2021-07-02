<?php

namespace App\Http\Controllers;
use App\Models\Network;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showPost(){
        return Profile::first();
    }

    public function getNetworks(){
        return Network::all();
    }

    public function deleteNetwork(Request $request){
        Network::find($request->id)->delete();

        $result = [
            'status' => true,
            'message' => 'network was deleted',
        ];

        return $result;
    }

    public function createNetwork(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return [
                'status'=>false,
                'errors'=> $validator->messages()
            ];
        }

        $network = new  Network([
            'name'=>$request->name,
            'link'=>$request->link,
        ]);

        $network->save();

        return[
            'status'=>true,
            'message' => 'network was added',
        ];
    }

    public function updatePost(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required|min:7',
            'education' => 'required',
            'skills' => 'required',
            'profile' => 'required',
            'experience' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status'=>false,
                'errors'=> $validator->messages()
            ];
        }

        $post = Profile::find($request->id);
        $post->name=$request->name;
        $post->email=$request->email;
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
