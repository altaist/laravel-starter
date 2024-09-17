<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait UserTasksTrait
{
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }

}
