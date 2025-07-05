<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /*get all users*/
    public function getUsers(){
        $users = User::all();
        return response()->json($users);
    }

    /*get single user*/
    public function getUser(Request $request, $id){
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /* create single user */
    public function createUser(Request $request){

        // $all = $request->all();
        // print '<pre>';
        // print_r($all);
        // print '<pre>';
        // exit;
        $request->validate([
            'role'=>'required',
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:6',
        ]);
        $user = User::create($request->all());
        return response()->json(['message'=> 'success', 'data'=>$user]);
    }
    /* update single user */
    public function updateUser(Request $request, $id){
        $request->validate([
            'role'=>'required',
            'name'=>'required',
            'email'=>'required|email|unique:users.email'.$id,
        ]);
        $user = User::findOrFail($id);
        return response()->json(['message'=> 'update successfully.', 'data'=>$user]);
    }
    /* delete single user */
    public function deleteUser($id){
        User::destroy($id);
        return response()->json(['message'=> 'delete successfully.', 'data'=>'']);
    }


}
