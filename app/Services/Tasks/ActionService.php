<?php

namespace App\Services\Tasks;

use App\Models\Tasks\Action;
use App\Models\User;
use App\Services\BaseService;

class ActionService extends BaseService
{
    public function createAction(int $userId, int $taskId, ?array $actionData): ?Action
    {
        $action = new Action();
        $action->user_id=$userId;
        $action->task_id=$taskId;
        $action->action_data = $actionData;
        $action->save();
        return $action;
    }

    public function createActionWithModeration(int $userId, int $taskId, ?array $actionData): ?Action
    {
        $action = $this->createAction($userId, $taskId, $actionData);
        $service = ModerationService::make();
        $service->createModeration($action->id);

        return $action;
    }

}
