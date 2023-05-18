<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Check;

use App\Models\Staff;
use App\Models\Counter;
use App\Models\Program;
use App\Models\Participant;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckControllerTest extends TestCase
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
    public function it_displays_index_view_with_checks(): void
    {
        $checks = Check::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('checks.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.checks.index')
            ->assertViewHas('checks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_check(): void
    {
        $response = $this->get(route('checks.create'));

        $response->assertOk()->assertViewIs('app.checks.create');
    }

    /**
     * @test
     */
    public function it_stores_the_check(): void
    {
        $data = Check::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('checks.store'), $data);

        $this->assertDatabaseHas('checks', $data);

        $check = Check::latest('id')->first();

        $response->assertRedirect(route('checks.edit', $check));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_check(): void
    {
        $check = Check::factory()->create();

        $response = $this->get(route('checks.show', $check));

        $response
            ->assertOk()
            ->assertViewIs('app.checks.show')
            ->assertViewHas('check');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_check(): void
    {
        $check = Check::factory()->create();

        $response = $this->get(route('checks.edit', $check));

        $response
            ->assertOk()
            ->assertViewIs('app.checks.edit')
            ->assertViewHas('check');
    }

    /**
     * @test
     */
    public function it_updates_the_check(): void
    {
        $check = Check::factory()->create();

        $staff = Staff::factory()->create();
        $counter = Counter::factory()->create();
        $participant = Participant::factory()->create();
        $program = Program::factory()->create();

        $data = [
            'isCheckIn' => $this->faker->boolean(),
            'staff_id' => $staff->id,
            'counter_id' => $counter->id,
            'participant_id' => $participant->id,
            'program_id' => $program->id,
        ];

        $response = $this->put(route('checks.update', $check), $data);

        $data['id'] = $check->id;

        $this->assertDatabaseHas('checks', $data);

        $response->assertRedirect(route('checks.edit', $check));
    }

    /**
     * @test
     */
    public function it_deletes_the_check(): void
    {
        $check = Check::factory()->create();

        $response = $this->delete(route('checks.destroy', $check));

        $response->assertRedirect(route('checks.index'));

        $this->assertModelMissing($check);
    }
}
