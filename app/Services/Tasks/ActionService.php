<?php

namespace App\Services\Tasks;

use App\Events\Tasks\ActionCreated;
use App\Models\Tasks\Action;
use App\Services\BaseService;
use Illuminate\Support\Facades\Event;

class ActionService extends BaseService
{
    public function createAction(int $userId, int $taskId, ?array $actionData): ?Action
    {
        $action = new Action();
        $action->user_id=$userId;
        $action->task_id=$taskId;
        $action->action_data = $actionData;
        $action->save();
        Event::dispatch(new ActionCreated($action));
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
