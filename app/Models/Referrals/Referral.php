<?php

namespace App\Models\Referrals;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referral extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    public function scopeByUserId(Builder $query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function parentUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent1_id');
    }

    public function parentUser2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent2_id');
    }

    public function parentUser3(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent3_id');
    }
}
