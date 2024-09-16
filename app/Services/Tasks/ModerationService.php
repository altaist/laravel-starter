<?php

namespace App\Services\Tasks;

use App\Models\Tasks\Moderation;
use App\Models\User;
use App\Services\BaseService;

class ModerationService extends BaseService
{
    public function createModeration(): Moderation
    {
        $moderation = new Moderation();
        $moderation->status = ModerationStatus::$NEW;
        $moderation->save();
        return $moderation;
    }

    public function attachModerator (int $moderationId, int $moderatorId): Moderation
    {
        $moderation = Moderation::findOrFail($moderationId);
        $moderation->moderator_id = $moderationId;
        $moderation->status = ModerationStatus::$MODERATING;
        $moderation->save();
        return $moderation;
    }

    public function approve (int $moderationId, int $result, array $moderationData = null): Moderation
    {
        return $this->update($moderationId, $result, ModerationStatus::$APROVED, $moderationData);
    }

    public function disapprove (int $moderationId, int $result, array $moderationData = null): Moderation
    {
        return $this->update($moderationId, $result, ModerationStatus::$DISAPROVED, $moderationData);
    }

    public function update(int $moderationId, int $result, int $status, array $moderationData = null): Moderation
    {
        $moderation = Moderation::findOrFail($moderationId);
        $moderation->moderator_id = $moderationId;
        $moderation->result = $result;
        $moderation->status = $status;
        $moderation->moderation_data = $moderationData;
        $moderation->save();
        return $moderation;

    }

}
