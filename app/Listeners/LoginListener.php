<?php

namespace App\Listeners;

use App\Services\Referrals\ReferralService;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $refKey = session('ref_key');

        if($user && $refKey) {
            ReferralService::make()->attachReferral($user, $refKey);
        }
    }
}
