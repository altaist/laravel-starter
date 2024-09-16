<?php

namespace App\Services\Tasks;

use App\Models\Tasks\Action;
use App\Models\User;
use App\Services\BaseService;

class ActionService extends BaseService
{
    public function createAction(User $user, ?array $actionData): ?Action
    {
        $action = new Action();
        $action->action_data = $actionData;
        $action->user()->save($user);
        return $action;

    }

    public function createActionWithModeration(User $user, ?array $actionData): ?Action
    {
        $action = $this->createAction($user, $actionData);
        $service = ModerationService::make();

        $moderation = $service->createModeration();
        $action->moderation()->save($moderation);

        return $action;
    }

}
