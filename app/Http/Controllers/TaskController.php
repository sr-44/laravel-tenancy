<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\Tenant;

class TaskController extends Controller
{
    public function index()
    {
        $currentTenant = auth()->user()->current_tenant_id;
//        $tenant = Tenant::find($currentTenant);
        $currentTenant = auth()->user()->getCurrentTenant();
//        dd(Tenant::find($currentTenant)->getOwner());
        $tasks = Task::with('project')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $projects = Project::all();

        return view('tasks.create', compact('projects'));
    }

    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $projects = Project::all();

        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
