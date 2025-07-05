<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function memberRegistration(Request $request){
        $validation = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|confirmed|min:6',
            'role'=>'required',
            'profile_image'=>'nullable',
        ]);

        if($validation->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'validation error',
                'errors'=> $validation->errors()
            ], status: 400);
        }

        $profile_image = null;
        if($request->hasFile(key:'profile_image')){
            $profile_image = $request->file(key:'profile_image')->store(path:'profile_images');
        }

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>$request->role,
            'password'=>Hash::make($request->password),
            'profile_image'=>$profile_image,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
                'status'=>true,
                'message'=>'Registration Successful.',
                'data'=> new UserResource($user),
                'token'=>$token
            ], status: 200);
    }

    public function login(Request $request){
        $validation = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if($validation->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'validation error',
                'errors'=> $validation->errors()
            ], status: 400);
        }

        $profile_image = null;
        if($request->hasFile(key:'profile_image')){
            $profile_image = $request->file(key:'profile_image')->store(path:'profile_images');
        }

 /*       $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>$request->role,
            'password'=>Hash::make($request->password),
            'profile_image'=>$profile_image,
        ]);
*/
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'status'=>false,
                'message'=>'Credential Not matched.',
            ], status: 400);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
                'status'=>true,
                'message'=>'Login Successful.',
                'data'=> new UserResource($user),
                'token'=>$token
            ], status: 200);

    }

    public function user(Request $request, $id){
        $user = User::find($id);
        return response()->json([
            'status'=>true,
            'message'=>'User fetched successfully.',
            'data'=> new UserResource($user)
        ], status:200);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Logout Successful.',
        ], status:200);
    }

    
}