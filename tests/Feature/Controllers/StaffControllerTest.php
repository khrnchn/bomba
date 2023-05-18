<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Staff;

use App\Models\Station;
use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StaffControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_staff(): void
    {
        $allStaff = Staff::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-staff.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_staff.index')
            ->assertViewHas('allStaff');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_staff(): void
    {
        $response = $this->get(route('all-staff.create'));

        $response->assertOk()->assertViewIs('app.all_staff.create');
    }

    /**
     * @test
     */
    public function it_stores_the_staff(): void
    {
        $data = Staff::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-staff.store'), $data);

        $this->assertDatabaseHas('staff', $data);

        $staff = Staff::latest('id')->first();

        $response->assertRedirect(route('all-staff.edit', $staff));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_staff(): void
    {
        $staff = Staff::factory()->create();

        $response = $this->get(route('all-staff.show', $staff));

        $response
            ->assertOk()
            ->assertViewIs('app.all_staff.show')
            ->assertViewHas('staff');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_staff(): void
    {
        $staff = Staff::factory()->create();

        $response = $this->get(route('all-staff.edit', $staff));

        $response
            ->assertOk()
            ->assertViewIs('app.all_staff.edit')
            ->assertViewHas('staff');
    }

    /**
     * @test
     */
    public function it_updates_the_staff(): void
    {
        $staff = Staff::factory()->create();

        $user = User::factory()->create();
        $station = Station::factory()->create();
        $department = Department::factory()->create();

        $data = [
            'referral_code' => $this->faker->text(255),
            'user_id' => $user->id,
            'station_id' => $station->id,
            'department_id' => $department->id,
        ];

        $response = $this->put(route('all-staff.update', $staff), $data);

        $data['id'] = $staff->id;

        $this->assertDatabaseHas('staff', $data);

        $response->assertRedirect(route('all-staff.edit', $staff));
    }

    /**
     * @test
     */
    public function it_deletes_the_staff(): void
    {
        $staff = Staff::factory()->create();

        $response = $this->delete(route('all-staff.destroy', $staff));

        $response->assertRedirect(route('all-staff.index'));

        $this->assertSoftDeleted($staff);
    }
}
