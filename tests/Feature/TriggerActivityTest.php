<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_project()
    {
        $project = Project::factory()->create();

        $this->assertCount(1, $project->activity);
        $this > assertEquals('created', $project->activity[0]->description);
    }

    /** @test */
    public function updating_a_project()
    {
        $project = Project::factory()->create();

        $project->update(['title' => 'Changed']);

        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);
    }

    /** @test */
    public function creating_a_new_task()
    {
        $project = Project::factory()->create();

        $project->addTask('Some task');

        $this->assertCount(2, $project->activity);
        $this->assertEquals('created_task', $project->activity->last()->description);
    }

    /** @test */
    public function completing_a_task()
    {
        $project = Project::factory()->create();

        Task::factory()->create([
            'project_id' => $project->id
        ]);

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => true
            ]);

        $this->assertCount(3, $project->activity);
        $this->assertEquals('completed_task', $project->activity->last()->description);
    }

    /** @test */
    public function uncompleting_a_task()
    {
        $project = Project::factory()->create();

        Task::factory()->create([
            'project_id' => $project->id
        ]);

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => true
            ]);

        $this->assertCount(3, $project->activity);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => false
        ]);

        $project->refresh();

        $this->assertCount(4, $project->activity);

        $this->assertEquals('uncompleted_task', $project->activity->last()->description);
    }

    /** @test */
    public function deleting_a_task()
    {
        $project = Project::factory()->create();

        Task::factory()->create([
            'project_id' => $project->id
        ]);

        $project->tasks[0]->delete();

        $this->assertCount(3, $project->activity);
    }
}
