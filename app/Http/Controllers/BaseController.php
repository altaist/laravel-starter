<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseRoutingController;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

abstract class BaseController extends BaseRoutingController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getAuthUser(): User
    {
        return Auth::user();
    }

    public function response($data, $status = 200)
    {
        return response($data, $status);
    }

    public function responseOk()
    {
        return $this->response("ok");
    }

    public function inertia(string $componentName, array $data = [])
    {
        return Inertia::render($componentName, ["data" => $data]);
    }

    public function inertiaFromResource(string $componentName, JsonResource $resource)
    {
        return Inertia::render($componentName, ["data" => $resource->toArray(request())]);
    }
}
