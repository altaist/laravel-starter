<?php

namespace App\Services\Tasks;

use App\Models\Tasks\Task;
use App\Models\Tasks\TaskType;
use App\Models\User;
use App\Services\BaseService;

class TaskService extends BaseService
{
    public function createTask(User $user, int $taskId, array $taskData, int $parentId = null): Task
    {
        $task = new Task();
        $task->author_id = $user->id;
        $task->task_type_id = $taskId;
        $task->parent_id = $parentId;
        $task->task_data = $taskData;
        $task->save();

        return $task;
    }

    public function attachUsers(int $taskId, array $userIds)
    {
        $task = Task::findOrFail($taskId);
        $task->users()->sync($userIds);
        return $task;
    }

}
