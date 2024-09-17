<?php

namespace App\Models\Tasks;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends BaseModel
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'task_data' => 'object',
        ];
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_type_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    public function actions(): HasMany
    {
        return $this->hasMany(Action::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
