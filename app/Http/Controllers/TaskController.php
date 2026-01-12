<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Lead;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function store(TaskRequest $request, Lead $lead)
    {
        $this->authorize('update', $lead); 

        $lead->tasks()->create($request->validated());

        return redirect()->route('leads.show', $lead)->with('success', 'Task added successfully.');
    }

    
    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        return redirect()->back()->with('success', 'Task updated successfully.');
    }
}
