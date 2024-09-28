<?php

namespace App\Http\Controllers;

use App\Services\Referrals\ReferralService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class HomeController extends BaseController
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $refKey = $request->get('startparam', session('ref_key'));
        if($refKey) {
            if($user) {
                ReferralService::make()->attachReferral($user, $refKey);
            }

            Session::put('ref_key', $refKey);
        }

        return $this->inertia('Welcome');
    }
}
