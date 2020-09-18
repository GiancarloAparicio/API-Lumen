<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Services\TaskService;

class TaskController extends Controller
{

    private $userCurrent;

    public function __construct(UserRepository $userRepository)
    {
        $this->userCurrent = $userRepository->getUserWithToken(request('api_token'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaskService $taskService)
    {
        $this->userCurrent->authorizeRoles(['user', 'moderator', 'admin']);
        return $taskService->getAllTasks();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskService $taskService)
    {
        $this->userCurrent->authorizeRoles(['moderator', 'admin']);
        return $taskService->createTask();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, TaskService $taskService)
    {
        $this->userCurrent->authorizeRoles(['user', 'moderator', 'admin']);
        return $taskService->getTaskById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, TaskService $taskService)
    {
        $this->userCurrent->authorizeRoles(['admin']);
        return $taskService->updateTaskById($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, TaskService $taskService)
    {
        $this->userCurrent->authorizeRoles(['admin']);
        return $taskService->deleteTask($id);
    }
}
