<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Organizer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganizerControllerTest extends TestCase
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
    public function it_displays_index_view_with_organizers(): void
    {
        $organizers = Organizer::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('organizers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.organizers.index')
            ->assertViewHas('organizers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_organizer(): void
    {
        $response = $this->get(route('organizers.create'));

        $response->assertOk()->assertViewIs('app.organizers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_organizer(): void
    {
        $data = Organizer::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('organizers.store'), $data);

        $this->assertDatabaseHas('organizers', $data);

        $organizer = Organizer::latest('id')->first();

        $response->assertRedirect(route('organizers.edit', $organizer));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_organizer(): void
    {
        $organizer = Organizer::factory()->create();

        $response = $this->get(route('organizers.show', $organizer));

        $response
            ->assertOk()
            ->assertViewIs('app.organizers.show')
            ->assertViewHas('organizer');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_organizer(): void
    {
        $organizer = Organizer::factory()->create();

        $response = $this->get(route('organizers.edit', $organizer));

        $response
            ->assertOk()
            ->assertViewIs('app.organizers.edit')
            ->assertViewHas('organizer');
    }

    /**
     * @test
     */
    public function it_updates_the_organizer(): void
    {
        $organizer = Organizer::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
        ];

        $response = $this->put(route('organizers.update', $organizer), $data);

        $data['id'] = $organizer->id;

        $this->assertDatabaseHas('organizers', $data);

        $response->assertRedirect(route('organizers.edit', $organizer));
    }

    /**
     * @test
     */
    public function it_deletes_the_organizer(): void
    {
        $organizer = Organizer::factory()->create();

        $response = $this->delete(route('organizers.destroy', $organizer));

        $response->assertRedirect(route('organizers.index'));

        $this->assertSoftDeleted($organizer);
    }
}
