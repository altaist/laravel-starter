<?php

namespace App\Services\Teams;

use App\Models\Teams\Meeting;
use App\Models\Teams\Team;
use App\Models\User;

class TeamService
{
    public function createTeam(int $authorId, string $title, string $description, int $teamTypeId, $related = null)
    {
        $team = new Team();
        $team->title = $title;
        $team->description = $description;
        $team->author_id = $authorId;
        $team->team_type_id = $teamTypeId;
        if($related){
            $team->related()->associate($related);
        }
        $team->save();
        return $team;
    }

    public function toggleUserToTeam(Team $team, User $user)
    {
        $team->users()->toggle($user);
        $team->refresh();
        return $team;

    }

    public function toggleMeetingToTeam(Team $team, Meeting $meeting)
    {
        $team->meetings()->toggle($meeting);
        $team->refresh();
        return $team;
    }

    public function getTeamUsers(Team $team, array $filters = null)
    {
        return $team->users;
    }

    public function getTeamMeetings(Team $team, array $filters = null)
    {
        return $team->meetings;
    }
}
