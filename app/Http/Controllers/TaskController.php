<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('project')->paginate(10);
        return view('task.index', compact('tasks'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('task.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'deskripsi' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:Belum Selesai,Selesai',
            'project_id' => 'required|exists:projects,id'
        ]);

        Task::create($validatedData);

        return redirect()->route('tasks.index')
            ->with('success', 'Task berhasil dibuat.');
    }

    public function show(Task $task)
    {
       //
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('task.edit', compact('task', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'deskripsi' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:Belum Selesai,Selesai',
            'project_id' => 'required|exists:projects,id'
        ]);

        $task->update($validatedData);

        return redirect()->route('tasks.index')
            ->with('success', 'Task berhasil diupdate.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task berhasil dihapus.');
    }
}
