<?php

namespace App\Models\Referrals;

use App\Models\Referrals\Referral;
use Illuminate\Database\Eloquent\Builder;

trait UserReferralsTrait
{
    public function scopeByRefKey(Builder $query, string $refKey)
    {
        return $query->where('ref_key', $refKey);
    }

    public function referrals ()
    {
        return $this->hasMany(Referral::class, 'parent1_id');
    }

    public function referralsLevel2 ()
    {
        return $this->hasMany(Referral::class, 'parent2_id');
    }

    public function referralsLevel3 ()
    {
        return $this->hasMany(Referral::class, 'parent3_id');
    }
}
