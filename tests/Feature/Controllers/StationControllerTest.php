<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Station;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationControllerTest extends TestCase
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
    public function it_displays_index_view_with_stations(): void
    {
        $stations = Station::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('stations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.stations.index')
            ->assertViewHas('stations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_station(): void
    {
        $response = $this->get(route('stations.create'));

        $response->assertOk()->assertViewIs('app.stations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_station(): void
    {
        $data = Station::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('stations.store'), $data);

        $this->assertDatabaseHas('stations', $data);

        $station = Station::latest('id')->first();

        $response->assertRedirect(route('stations.edit', $station));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_station(): void
    {
        $station = Station::factory()->create();

        $response = $this->get(route('stations.show', $station));

        $response
            ->assertOk()
            ->assertViewIs('app.stations.show')
            ->assertViewHas('station');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_station(): void
    {
        $station = Station::factory()->create();

        $response = $this->get(route('stations.edit', $station));

        $response
            ->assertOk()
            ->assertViewIs('app.stations.edit')
            ->assertViewHas('station');
    }

    /**
     * @test
     */
    public function it_updates_the_station(): void
    {
        $station = Station::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'world_city_id' => $this->faker->randomNumber(),
            'world_division_id' => $this->faker->randomNumber(),
        ];

        $response = $this->put(route('stations.update', $station), $data);

        $data['id'] = $station->id;

        $this->assertDatabaseHas('stations', $data);

        $response->assertRedirect(route('stations.edit', $station));
    }

    /**
     * @test
     */
    public function it_deletes_the_station(): void
    {
        $station = Station::factory()->create();

        $response = $this->delete(route('stations.destroy', $station));

        $response->assertRedirect(route('stations.index'));

        $this->assertModelMissing($station);
    }
}
