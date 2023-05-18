<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Feedback;

use App\Models\Program;
use App\Models\Participant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedbackControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_feedbacks(): void
    {
        $feedbacks = Feedback::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('feedbacks.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.feedbacks.index')
            ->assertViewHas('feedbacks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_feedback(): void
    {
        $response = $this->get(route('feedbacks.create'));

        $response->assertOk()->assertViewIs('app.feedbacks.create');
    }

    /**
     * @test
     */
    public function it_stores_the_feedback(): void
    {
        $data = Feedback::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('feedbacks.store'), $data);

        $this->assertDatabaseHas('feedbacks', $data);

        $feedback = Feedback::latest('id')->first();

        $response->assertRedirect(route('feedbacks.edit', $feedback));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_feedback(): void
    {
        $feedback = Feedback::factory()->create();

        $response = $this->get(route('feedbacks.show', $feedback));

        $response
            ->assertOk()
            ->assertViewIs('app.feedbacks.show')
            ->assertViewHas('feedback');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_feedback(): void
    {
        $feedback = Feedback::factory()->create();

        $response = $this->get(route('feedbacks.edit', $feedback));

        $response
            ->assertOk()
            ->assertViewIs('app.feedbacks.edit')
            ->assertViewHas('feedback');
    }

    /**
     * @test
     */
    public function it_updates_the_feedback(): void
    {
        $feedback = Feedback::factory()->create();

        $program = Program::factory()->create();
        $participant = Participant::factory()->create();

        $data = [
            'comment' => $this->faker->text(),
            'rating' => $this->faker->text(255),
            'feedback_photo_path' => $this->faker->text(),
            'program_id' => $program->id,
            'participant_id' => $participant->id,
        ];

        $response = $this->put(route('feedbacks.update', $feedback), $data);

        $data['id'] = $feedback->id;

        $this->assertDatabaseHas('feedbacks', $data);

        $response->assertRedirect(route('feedbacks.edit', $feedback));
    }

    /**
     * @test
     */
    public function it_deletes_the_feedback(): void
    {
        $feedback = Feedback::factory()->create();

        $response = $this->delete(route('feedbacks.destroy', $feedback));

        $response->assertRedirect(route('feedbacks.index'));

        $this->assertModelMissing($feedback);
    }
}
