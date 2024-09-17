<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Tasks\TaskType;
use App\Models\User;
use App\Services\Tasks\ActionService;
use App\Services\Tasks\ModerationService;
use App\Services\Tasks\ModerationStatus;
use App\Services\Tasks\TaskService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_creating_task(): void
    {
        $user1 = User::factory()->create();
        $taskType = TaskType::factory()->create();

        $taskService = TaskService::make();

        $task = $taskService->createTask($user1, $taskType->id, ['text' => 'Task description']);
        $this->assertNotNull($task);
        $this->assertNotNull($task->type);
        $this->assertNotNull($task->author);
        $this->assertNull($task->parent);
        $this->assertEquals($task->type->id, $taskType->id);
        $this->assertEquals($task->author->id, $user1->id);
        $this->assertEquals($task->task_data->text, 'Task description');

        $task2 = $taskService->createTask($user1, $taskType->id, ['text' => 'Task 2 description'], $task->id);
        $this->assertNotEquals($task->id, $task2->id);
        $this->assertNotNull($task2->parent);
        $this->assertEquals($task2->parent->id, $task->id);
    }

    public function test_task_users(): void
    {
        $author = User::factory()->create();
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $taskType1 = TaskType::factory()->create();

        $taskService = TaskService::make();

        $task1 = $taskService->createTask($author, $taskType1->id, ['text' => 'Task description']);
        $task2 = $taskService->createTask($author, $taskType1->id, ['text' => 'Task 2 description'], $task1->id);

        $task1 = $taskService->attachUsers($task1->id, [
            $user1->id,
            $user2->id
        ]);

        $this->assertNotNull($task1->users);
        $this->assertCount(2, $task1->users);

        $task1 = $taskService->attachUsers($task1->id, [
            $user1->id
        ]);

        $this->assertNotNull($task1->users);
        $this->assertCount(1, $task1->users);
    }

}
