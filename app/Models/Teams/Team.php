<?php

namespace App\Models\Teams;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends BaseModel
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(TeamType::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function meetings(): BelongsToMany
    {
        return $this->belongsToMany(Meeting::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

}
