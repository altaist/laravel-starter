<?php

namespace App\Services\Tasks;

use App\Events\Tasks\ModerationCreated;
use App\Events\Tasks\ModeratorAttached;
use App\Models\Tasks\Moderation;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Event;

class ModerationService extends BaseService
{
    public function createModeration(int $actionId): Moderation
    {
        $moderation = new Moderation();
        $moderation->status = ModerationStatus::$NEW;
        $moderation->action_id = $actionId;
        $moderation->save();
        Event::dispatch(new ModerationCreated($moderation));

        return $moderation;
    }

    public function attachModerator (int $moderationId, int $moderatorId): Moderation
    {
        $moderation = Moderation::findOrFail($moderationId);
        $moderatorUser = User::findOrFail($moderatorId);
        $moderation->moderator_id = $moderatorId;
        $moderation->status = ModerationStatus::$MODERATING;
        $moderation->save();
        Event::dispatch(new ModeratorAttached($moderation, $moderatorUser));

        return $moderation;
    }

    public function detachModerator (int $moderationId): Moderation
    {
        $moderation = Moderation::findOrFail($moderationId);
        $moderation->moderator_id = null;
        $moderation->status = ModerationStatus::$NEW;
        $moderation->save();
        return $moderation;
    }

    public function approve (int $moderationId, int $result = 0, array $moderationData = null): Moderation
    {
        return $this->update($moderationId, $result, ModerationStatus::$APROVED, $moderationData);
    }

    public function disapprove (int $moderationId, int $result = 0, array $moderationData = null): Moderation
    {
        return $this->update($moderationId, $result, ModerationStatus::$DISAPROVED, $moderationData);
    }

    public function update(int $moderationId, int $result, int $status, array $moderationData = null): Moderation
    {
        $moderation = Moderation::findOrFail($moderationId);
        $moderation->result = $result;
        $moderation->status = $status;
        $moderation->moderation_data = $moderationData;
        $moderation->save();
        return $moderation;
    }

}
