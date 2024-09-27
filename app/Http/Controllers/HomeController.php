<?php

namespace App\Http\Controllers;

use App\Services\Referrals\ReferralService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if($user) {
            $refKey = $request->get('startparam');
            if($refKey) {
                ReferralService::make()->attachReferral($user, $refKey);
            }
        }

        return $this->inertia('Welcome');
    }
}
