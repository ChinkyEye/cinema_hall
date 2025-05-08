<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tasks = Task::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'category' => $request['category'],
            'reminder' => $request['reminder'],
            'created_by' => Auth::user()->id,
        ]);
        return response()->json([
            'message' => 'Task created',
            'status' => 'success',
            'data' => $tasks,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $main_data = $request->all();
        $datas = $task->update($main_data);
        if($datas){
            $notification = array(
            'message' => 'Data updated successfully!',
            'alert-type' => 'success'
            );
        }else{
            $notification = array(
            'message' => 'Data could not be updated!',
            'alert-type' => 'error'
            );
        }
        return response()->json($notification); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if($task->delete()){
            $notification = array(
              'message' => 'data is deleted successfully!',
              'status' => 'success'
          );
        }else{
            $notification = array(
              'message' => 'data could not be deleted!',
              'status' => 'error'
          );
        }
        return response()->json($notification);
    }

    public function toggleStatus($id)
    {
        $task = Task::findOrFail($id);

        $task->status = $task->status === 'Completed' ? 'Pending' : 'Completed';
        $task->save();

        return response()->json([
            'success' => true,
            'message' => 'Task status updated successfully.',
            'data' => [
                'id' => $task->id,
                'new_status' => $task->status
            ]
        ]);
    }
}
