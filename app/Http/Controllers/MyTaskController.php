<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;



class MyTaskController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('test', ['only'=> ['getProfile']]);
        //
    }

    public function generateKey()
    {
        return str_random(32);
    }
    
    public function getListTask()
    {
        $res = Task::all();
        return response()->json($res);
    } 

    public function getDetailTask($id)
    {
        $res = Task::find($id);
        return response()->json($res);
    }

    public function addTask(Request $request)
    {
        $data = new Task();
        $data->title= $request->input('title');
        $data->done=$request->input('done');

        // return $request;

        $data->save();

        $response = [
            'code' => 200,
            'status' => 'succcess',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function deleteTask($id)
    {   
        $data= Task::where('id', $id)->first();
        $data->delete();

        $response = [
            'code' => 200,
            'status' => 'success',
            'data' => [$data],
            'message' => 'Resource deleted'
            ];
            
        return response()->json($response, $response['code']);
    }

    public function completeTask($id)
    {
        $data= Task::where('id',$id)->first();
        $data ->done = 1;
        $data->save();
        $response = [
            'code' => 200,
            'status' => 'succcess',
            'data' => $data
            ];
        return response()->json($response, $response['code']);
    }

    public function uncompleteTask($id)
    {
        $data = Task::where('id',$id)->first();
        $data->done = 0;
        $data->save();

        $response = [
            'code' => 200,
            'status' => 'succcess',
            'data' => $data
            ];
            return response()->json($response, $response['code']);
    }
}
