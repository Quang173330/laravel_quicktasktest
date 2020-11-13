<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('tasks.index')
                ->withInput()
                ->withErrors($validator);
        }
        Task::create($request->all());

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        $users = $task->users()->get();
        return view('tasks.view', [
            'task' => $task,
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $users = $task->users()->get();
        $users1 = User::all()->diff($users);
        return view('tasks.edit', [
            'task' => $task,
            'users' => $users,
            'users1' => $users1
        ]);
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
        $task = Task::find($id);
        if ($request->delete_user) {
            $task->users()->detach($request->delete_user);
        }
        if ($request->add_user) {
            $task->users()->attach($request->add_user);
        }
        if ($request->name) {
            $task->name = $request->name;
            $task->description = $request->description;
            $task->save();
        }
        return redirect()->route('tasks.edit', ["task" => $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        foreach ($task->users as $user) {
            $user->pivot->delete();
        }
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
