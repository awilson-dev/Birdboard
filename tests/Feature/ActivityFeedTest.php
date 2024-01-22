<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_project_generates_activity()
    {
        $project = Project::factory()->create();

        $this->assertCount(1, $project->activity);
        $this>assertEquals('created', $project->activity[0]->description);
    }

    /** @test */
    public function updating_a_project_generates_activity()
    {
        $project = Project::factory()->create();
        
        $project->update(['title' => 'Changed']);

        $this->assertCount(2, $project->activity);
        $this->assertEquals('updated', $project->activity->last()->description);
    }
}
