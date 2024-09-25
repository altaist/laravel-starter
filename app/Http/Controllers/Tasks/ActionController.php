<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\BaseController;
use App\Services\Tasks\ActionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionController extends BaseController
{
    public function create(int $taskId, Request $request)
    {
        $user = Auth::user();
        $service = ActionService::make();

        $validated = $this->validate($request, [
            'action_data' => 'array'
        ]);

        $actionData = $validated['action_data'];
        $action = $service->createActionWithModeration($user->id, $taskId, $actionData);
        return response()->json($action);
    }
}
