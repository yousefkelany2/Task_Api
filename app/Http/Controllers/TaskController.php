<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Task = Task::with('user')->get();
        return view("dashbord.task.view",compact("Task"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $User =User::get();
        return view("dashbord.task.add",compact("User"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        Task::create($request->toArray());
        return to_route("task.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task=Task::findOrfail($id);
        $User = User::get();
        return view("dashbord.task.update",compact("task","User"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->except("_token","_method");
        Task::where("id",$id)->update($data);
        return to_route("task.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::where("id",$id)->delete();
        return to_route("task.index");
    }
}
