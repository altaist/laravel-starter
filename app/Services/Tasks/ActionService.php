<?php

namespace App\Services\Tasks;

use App\Models\Tasks\Action;
use App\Models\User;
use App\Services\BaseService;

class ActionService extends BaseService
{
    public function createAction(int $userId, ?array $actionData): ?Action
    {
        $action = new Action();
        $action->action_data = $actionData;
        $action->user_id=$userId;
        $action->save();
        return $action;
    }

    public function createActionWithModeration(int $userId, ?array $actionData): ?Action
    {
        $action = $this->createAction($userId, $actionData);
        $service = ModerationService::make();
        $service->createModeration($action->id);

        return $action;
    }

}
