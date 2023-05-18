<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Counter;

use App\Models\Program;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CounterControllerTest extends TestCase
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
    public function it_displays_index_view_with_counters(): void
    {
        $counters = Counter::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('counters.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.counters.index')
            ->assertViewHas('counters');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_counter(): void
    {
        $response = $this->get(route('counters.create'));

        $response->assertOk()->assertViewIs('app.counters.create');
    }

    /**
     * @test
     */
    public function it_stores_the_counter(): void
    {
        $data = Counter::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('counters.store'), $data);

        $this->assertDatabaseHas('counters', $data);

        $counter = Counter::latest('id')->first();

        $response->assertRedirect(route('counters.edit', $counter));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_counter(): void
    {
        $counter = Counter::factory()->create();

        $response = $this->get(route('counters.show', $counter));

        $response
            ->assertOk()
            ->assertViewIs('app.counters.show')
            ->assertViewHas('counter');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_counter(): void
    {
        $counter = Counter::factory()->create();

        $response = $this->get(route('counters.edit', $counter));

        $response
            ->assertOk()
            ->assertViewIs('app.counters.edit')
            ->assertViewHas('counter');
    }

    /**
     * @test
     */
    public function it_updates_the_counter(): void
    {
        $counter = Counter::factory()->create();

        $program = Program::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
            'isCheckIn' => $this->faker->boolean(),
            'program_id' => $program->id,
        ];

        $response = $this->put(route('counters.update', $counter), $data);

        $data['id'] = $counter->id;

        $this->assertDatabaseHas('counters', $data);

        $response->assertRedirect(route('counters.edit', $counter));
    }

    /**
     * @test
     */
    public function it_deletes_the_counter(): void
    {
        $counter = Counter::factory()->create();

        $response = $this->delete(route('counters.destroy', $counter));

        $response->assertRedirect(route('counters.index'));

        $this->assertModelMissing($counter);
    }
}
