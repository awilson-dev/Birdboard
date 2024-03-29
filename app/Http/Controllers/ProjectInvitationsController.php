<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project, ProjectInvitationRequest $request)
    {
        $user = User::whereEmail(request('email'))->first();

        $project->invite($user);

        return redirect($project->path());
    }

    public function destroy(Project $project, User $user)
    {
        $this->authorize('update', $project);

        $project->remove($user);

        return response()->json(['message' => 'User removed successfully']);
    }
}
