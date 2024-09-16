<?php

namespace App\Models\Tasks;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Action extends BaseModel
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'action_data' => 'array',
        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function moderation(): HasOne
    {
        return $this->hasOne(Moderation::class);
    }

}
