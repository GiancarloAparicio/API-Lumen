<?php

namespace App\Services;

use App\Models\Task;
use App\Traits\Response;
use App\Validator\TaskValidator;

class TaskService
{

    use Response;

    private $task;
    private  $taskValidator;

    public function __construct(Task $task, TaskValidator $taskValidator)
    {
        $this->task = $task;
        $this->taskValidator = $taskValidator;
    }

    public function createTask()
    {
        $validate = $this->taskValidator->validate();
        $this->task::create($validate);
        return $this->successResponse('Create task', $validate, 201);
    }

    public function getAllTasks()
    {
        $task = $this->task::get();
        return $this->successResponse('Show task all', $task, 200);
    }

    public function getTaskById(int $id)
    {
        $task = $this->task::findOrFail($id);
        return $this->successResponse('Show task', $task, 200);
    }

    public function updateTaskById(String $id)
    {
        $validate = $this->taskValidator->validate();
        $task = $this->task::findOrFail($id);
        $task->update($validate);
        return $this->successResponse('Update task', $task, 201);
    }

    public function deleteTask(int $id)
    {
        $task = $this->task::findOrFail($id);
        $task->delete();
        return $this->successResponse('Delete task', $task, 205);
    }
}
