<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Participant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipantControllerTest extends TestCase
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
    public function it_displays_index_view_with_participants(): void
    {
        $participants = Participant::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('participants.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.participants.index')
            ->assertViewHas('participants');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_participant(): void
    {
        $response = $this->get(route('participants.create'));

        $response->assertOk()->assertViewIs('app.participants.create');
    }

    /**
     * @test
     */
    public function it_stores_the_participant(): void
    {
        $data = Participant::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('participants.store'), $data);

        unset($data['isMalaysian']);
        unset($data['user_id']);
        unset($data['world_country_id']);
        unset($data['world_division_id']);

        $this->assertDatabaseHas('participants', $data);

        $participant = Participant::latest('id')->first();

        $response->assertRedirect(route('participants.edit', $participant));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_participant(): void
    {
        $participant = Participant::factory()->create();

        $response = $this->get(route('participants.show', $participant));

        $response
            ->assertOk()
            ->assertViewIs('app.participants.show')
            ->assertViewHas('participant');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_participant(): void
    {
        $participant = Participant::factory()->create();

        $response = $this->get(route('participants.edit', $participant));

        $response
            ->assertOk()
            ->assertViewIs('app.participants.edit')
            ->assertViewHas('participant');
    }

    /**
     * @test
     */
    public function it_updates_the_participant(): void
    {
        $participant = Participant::factory()->create();

        $user = User::factory()->create();

        $data = [
            'isMalaysian' => $this->faker->boolean(),
            'world_country_id' => $this->faker->randomNumber(),
            'world_division_id' => $this->faker->randomNumber(),
            'user_id' => $user->id,
        ];

        $response = $this->put(
            route('participants.update', $participant),
            $data
        );

        unset($data['isMalaysian']);
        unset($data['user_id']);
        unset($data['world_country_id']);
        unset($data['world_division_id']);

        $data['id'] = $participant->id;

        $this->assertDatabaseHas('participants', $data);

        $response->assertRedirect(route('participants.edit', $participant));
    }

    /**
     * @test
     */
    public function it_deletes_the_participant(): void
    {
        $participant = Participant::factory()->create();

        $response = $this->delete(route('participants.destroy', $participant));

        $response->assertRedirect(route('participants.index'));

        $this->assertSoftDeleted($participant);
    }
}
