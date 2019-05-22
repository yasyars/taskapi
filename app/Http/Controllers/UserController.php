<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        // $this->middleware('test', ['only'=> ['getProfile']]);
        //
    }

    public function getProfile($username)
    {
        $user = User::where('username',$username);
        return response()->json($user);
    }

    public function addUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->username = $requst->username;
        $user->password = $request->password;
        $user->save();

        $response = [
            'code' => 200,
            'status' => 'succcess',
            'data' => $user
        ];
        return response()->json($response, 200);
    }

    public function editProfile(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        if ($request->name!=NULL){
            $user->name = $request->name;
        }
        
        if ($request->username!=NULL){
            $user->username = $request->username;
        }

        if ($request->password!=NULL){
            $user->password = $request->password;
        }
        
        $user->save();
        $response = [
            'code' => 200,
            'status' => 'succcess',
            'data' => $user
        ];
        return response()->json($response, 200);
    }

}
