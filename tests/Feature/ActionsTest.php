<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Tasks\Action;
use App\Models\Tasks\Moderation;
use App\Models\User;
use App\Services\Tasks\ActionService;
use App\Services\Tasks\ModerationService;
use App\Services\Tasks\ModerationStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActionsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_creating_action(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $actionService = ActionService::make();
        $taskId = 1;

        $action = $actionService->createAction($user1->id, $taskId, ['text'=>'Anser text']);
        $this->assertNotNull($action);
        $this->assertNull($action->moderation);
        $this->assertEquals($action->user->id, $user1->id);
        $this->assertNotNull($action->action_data);

        $action = $actionService->createActionWithModeration($user1->id, $taskId, ['text'=>'Anser text']);
        $this->assertNotNull($action);
        $this->assertNotNull($action->moderation);
        $this->assertEquals($action->user->id, $user1->id);
        $this->assertEquals($action->moderation->action->id, $action->id);
        $this->assertNotNull($action->action_data);
        $this->assertEquals($action->action_data->text, 'Anser text');
        $this->assertEquals($action->moderation->status, ModerationStatus::$NEW);
        $this->assertNull($action->moderation->moderation_data);
        $this->assertNull($action->moderation->moderator);

        $action2 = $actionService->createActionWithModeration($user2->id, $taskId, ['text'=>'Anser text']);
        $this->assertNotNull($action2);
        $this->assertNotNull($action2->moderation);
        $this->assertEquals($action2->user->id, $user2->id);
        $this->assertNotEquals($action->id, $action2->id);

    }

    public function test_moderation_lifecicle(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $moderator1 = User::factory()->create();
        $moderator2 = User::factory()->create();

        $actionService = ActionService::make();
        $moderationService = ModerationService::make();
        $taskId = 1;

        $action1 = $actionService->createActionWithModeration($user1->id, $taskId, ['text'=>'Anser text 1']);
        $action2 = $actionService->createActionWithModeration($user2->id, $taskId,  ['text'=>'Anser text 2']);

        $moderation1 = $action1->moderation;
        $this->assertNull($moderation1->moderator);
        $this->assertEquals($moderation1->status, ModerationStatus::$NEW);

        $moderation1 = $moderationService->attachModerator($moderation1->id, $moderator1->id);
        $this->assertNotNull($moderation1->moderator);
        $this->assertEquals($moderation1->moderator->id, $moderator1->id);
        $this->assertEquals($moderation1->status, ModerationStatus::$MODERATING);

        $moderation1 = $moderationService->attachModerator($moderation1->id, $moderator2->id);
        $this->assertNotNull($moderation1->moderator);
        $this->assertEquals($moderation1->moderator->id, $moderator2->id);
        $this->assertEquals($moderation1->status, ModerationStatus::$MODERATING);

        $moderation1d = $moderationService->detachModerator($moderation1->id, $moderator1->id);
        $this->assertNull($moderation1d->moderator);
        $this->assertEquals($moderation1d->status, ModerationStatus::$NEW);
        $this->assertEquals($moderation1d->id, $moderation1->id);

        $moderation1 = $moderationService->attachModerator($moderation1->id, $moderator2->id);
        $this->assertNotNull($moderation1->moderator);
        $this->assertEquals($moderation1->moderator->id, $moderator2->id);
        $this->assertEquals($moderation1->status, ModerationStatus::$MODERATING);

        $moderation1 = $moderationService->attachModerator($moderation1->id, $moderator1->id);
        $this->assertNotNull($moderation1->moderator);
        $this->assertEquals($moderation1d->id, $moderation1->id);
        $this->assertEquals($moderation1->status, ModerationStatus::$MODERATING);

        $moderation1 = $moderationService->approve($moderation1->id);
        $this->assertNotNull($moderation1->moderator);
        $this->assertEquals($moderation1->moderator->id, $moderator1->id);
        $this->assertEquals($moderation1->status, ModerationStatus::$APROVED);

        $moderation1 = $moderationService->approve($moderation1->id, 12, ['text' => 'Approved comment']);
        $this->assertNotNull($moderation1->moderator);
        $this->assertEquals($moderation1->moderator->id, $moderator1->id);
        $this->assertEquals($moderation1->status, ModerationStatus::$APROVED);
        $this->assertEquals($moderation1->result, 12);
        $this->assertNotNull($moderation1->moderation_data);
        $this->assertEquals($moderation1->moderation_data->text, 'Approved comment');

        $moderation1 = $moderationService->disapprove($moderation1->id, 10, ['text' => 'Disapproved comment']);
        $this->assertNotNull($moderation1->moderator);
        $this->assertEquals($moderation1->moderator->id, $moderator1->id);
        $this->assertEquals($moderation1->status, ModerationStatus::$DISAPROVED);
        $this->assertEquals($moderation1->result, 10);
        $this->assertNotNull($moderation1->moderation_data);
        $this->assertEquals($moderation1->moderation_data->text, 'Disapproved comment');

    }

    public function test_action_controller(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();


        $response = $this->actingAs($user2)->postJson('/task/1/action', [
            'action_data' => ['text' => '123']
        ]);
        $response->assertOk();
        $this->assertCount(1, Action::all());
        $this->assertCount(1, Moderation::all());
        $this->assertEquals($user2->id, Action::first()->user_id);
    }

}
