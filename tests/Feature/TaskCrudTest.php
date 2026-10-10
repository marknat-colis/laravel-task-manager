<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_tasks(): void
    {
        $this->get('/tasks')->assertRedirect('/login');
        $this->post('/tasks', ['title' => 'No account'])->assertRedirect('/login');
    }

    public function test_authenticated_user_can_create_read_update_and_delete_a_task(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('tasks.index'))->assertOk()->assertSee('My Tasks');
        $this->post(route('tasks.store'), [
            'title' => 'Complete Laravel lab',
            'description' => 'Implement authentication and CRUD.',
        ])->assertRedirect(route('tasks.index'));

        $task = Task::sole();
        $this->assertSame($user->id, $task->user_id);
        $this->get(route('tasks.show', $task))->assertOk()->assertSeeText('Complete Laravel lab');
        $this->get(route('tasks.edit', $task))->assertOk();
        $this->put(route('tasks.update', $task), [
            'title' => 'Finish and review Laravel lab',
            'description' => 'Ready for submission',
        ])->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => 'Finish and review Laravel lab']);
        $this->delete(route('tasks.destroy', $task))->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_users_only_see_their_own_tasks_and_cannot_modify_others(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $privateTask = $other->tasks()->create(['title' => 'Secret task', 'description' => 'Other user data']);
        $owner->tasks()->create(['title' => 'My own task']);

        $this->actingAs($owner)->get(route('tasks.index'))
            ->assertOk()->assertSeeText('My own task')->assertDontSeeText('Secret task');

        $this->get(route('tasks.show', $privateTask))->assertForbidden();
        $this->get(route('tasks.edit', $privateTask))->assertForbidden();
        $this->put(route('tasks.update', $privateTask), ['title' => 'Stolen'])->assertForbidden();
        $this->delete(route('tasks.destroy', $privateTask))->assertForbidden();
        $this->assertDatabaseHas('tasks', ['id' => $privateTask->id, 'title' => 'Secret task']);
    }

    public function test_submitted_user_id_cannot_change_task_ownership(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $this->actingAs($user)->post(route('tasks.store'), [
            'title' => 'Mine', 'user_id' => $other->id,
        ])->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['title' => 'Mine', 'user_id' => $user->id]);
    }

    public function test_title_is_required_and_description_is_limited(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('tasks.store'), ['title' => '', 'description' => str_repeat('x', 2001)])
            ->assertSessionHasErrors(['title', 'description']);
        $this->assertDatabaseCount('tasks', 0);
    }

    public function test_dashboard_shows_only_users_task_count(): void
    {
        $me = User::factory()->create();
        $another = User::factory()->create();
        $me->tasks()->create(['title' => 'First task']);
        $another->tasks()->create(['title' => 'Others task']);
        $this->actingAs($me)->get(route('dashboard'))->assertOk()->assertSeeText('First task')->assertDontSeeText('Others task');
    }
}
