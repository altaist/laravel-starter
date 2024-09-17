<?php

namespace App\Models\Tasks;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Moderation extends BaseModel
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
            'moderation_data' => 'object',
        ];
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Action::class, "action_id", "user_id");
    }

    public function task()
    {
        return $this->hasOneThrough(Task::class, Action::class, "action_id", "task_id");
    }

    public function moderator()
    {
        return $this->belongsTo(User::class, 'moderator_id');
    }

    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class);
    }
}
