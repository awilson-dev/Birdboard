<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_owners_may_not_invite_users()
    {
        $project = Project::factory()->create();
        $user = User::factory()->create();

        $assertInvitationForbidden = function () use ($user, $project) {
            $this->actingAs($user)
                ->post($project->path() . '/invitations')
                ->assertStatus(403);
        };

        $assertInvitationForbidden();

        $project->invite($user);

        $assertInvitationForbidden();
    }

    /** @test */
    public function a_project_owner_can_invite_a_user()
    {
        $project = Project::factory()->create();

        $userToInvite = User::factory()->create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => $userToInvite->email
            ])
            ->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($userToInvite));
    }

    // /** @test */
    // public function a_project_owner_can_remove_a_user()
    // {
    //     $this->withoutExceptionHandling();

    //     $project = Project::factory()->create();

    //     $userToInvite = User::factory()->create();

    //     $this->actingAs($project->owner)
    //         ->post($project->path() . '/invitations', [
    //             'email' => $userToInvite->email
    //         ]);

    //     dump($project->members->toArray());

    //     $this->assertTrue($project->members->contains($userToInvite));

    //     $this->actingAs($project->owner)
    //         ->delete($project->path() . '/invitations/' . $userToInvite->id)
    //         ->assertRedirect($project->path());

    //     dump($project->members->toArray());

    //     $this->assertFalse($project->members->contains($userToInvite));
    // }

    /** @test */
    public function a_project_owner_can_remove_a_user()
    {
        $this->withoutExceptionHandling();

        $project = Project::factory()->create();
        $userToInvite = User::factory()->create();

        // Inviting the user
        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => $userToInvite->email
            ]);

        // Asserting that the user is a member
        $this->assertTrue($project->members->contains($userToInvite));

        // Removing the user
        $this->actingAs($project->owner)
            ->delete($project->path() . '/invitations/' . $userToInvite->id);

        // Asserting that the user is no longer a member
        $this->assertFalse($project->fresh()->members->contains($userToInvite));
    }

    /** @test */
    public function the_email_address_must_be_associated_with_a_valid_birdboard_account()
    {
        $project = Project::factory()->create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invitations', [
                'email' => 'notauser@example.com'
            ])
            ->assertSessionHasErrors([
                'email' => 'The user you are inviting must have a Birdboard account.'
            ], null, 'invitations');
    }

    /** @test */
    public function invited_users_may_update_project_details()
    {
        $project = Project::factory()->create();

        $project->invite($newUser = User::factory()->create());

        $this->signIn($newUser);
        $this->post("/projects/{$project->id}/tasks", $task = ['body' => 'New task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
