<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        $this->recordActivity($project, 'created');
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        $this->recordActivity($project, 'updated');
    }

    protected function recordActivity($project, $type)
    {
        Activity::create([
            'project_id' => $project->id,
            'description' => $type
        ]);
    }
}
