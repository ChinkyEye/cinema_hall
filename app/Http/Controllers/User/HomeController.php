<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use App\Notifications\TaskOverdue;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $overdueTasks = Task::where('reminder', '<', Carbon::now())
                    ->where('status', '!=', 'Completed')
                    ->get();
                    // dd($overdueTasks, Carbon::now());

                    foreach ($overdueTasks as $task) {
                        $alreadyNotified = $user->notifications()
                        ->where('data->task_id', $task->id)
                        ->where('type', 'App\Notifications\TaskOverdue')
                        ->exists();

                        if (!$alreadyNotified) {
                            $user->notify(new TaskOverdue($task));
                        }
                    }    

        $total_tasks = Task::where('created_by',Auth::user()->id)->count();
        $count_complete = Task::where('created_by', Auth::user()->id)
                                ->where('status','Completed')
                                ->count(); 
        $count_pending = Task::where('created_by', Auth::user()->id)
                                ->where('status','Pending')
                                ->count(); 
        $progress = $total_tasks > 0 ? ($count_complete / $total_tasks) * 100 : 0;                        
        $count_list = collect([
                            ['completed' => $count_complete], 
                            ['pending' => $count_pending],
                            ['total_tasks' => $total_tasks], 
                        ])->collapse()->all();                                        
        return view('user.main.home', compact(['count_list'],'progress','overdueTasks'));
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
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
