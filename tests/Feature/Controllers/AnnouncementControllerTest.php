<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Announcement;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnnouncementControllerTest extends TestCase
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
    public function it_displays_index_view_with_announcements(): void
    {
        $announcements = Announcement::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('announcements.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.announcements.index')
            ->assertViewHas('announcements');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_announcement(): void
    {
        $response = $this->get(route('announcements.create'));

        $response->assertOk()->assertViewIs('app.announcements.create');
    }

    /**
     * @test
     */
    public function it_stores_the_announcement(): void
    {
        $data = Announcement::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('announcements.store'), $data);

        $this->assertDatabaseHas('announcements', $data);

        $announcement = Announcement::latest('id')->first();

        $response->assertRedirect(route('announcements.edit', $announcement));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_announcement(): void
    {
        $announcement = Announcement::factory()->create();

        $response = $this->get(route('announcements.show', $announcement));

        $response
            ->assertOk()
            ->assertViewIs('app.announcements.show')
            ->assertViewHas('announcement');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_announcement(): void
    {
        $announcement = Announcement::factory()->create();

        $response = $this->get(route('announcements.edit', $announcement));

        $response
            ->assertOk()
            ->assertViewIs('app.announcements.edit')
            ->assertViewHas('announcement');
    }

    /**
     * @test
     */
    public function it_updates_the_announcement(): void
    {
        $announcement = Announcement::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->text(255),
            'image_path' => $this->faker->text(),
            'file_path' => $this->faker->text(),
        ];

        $response = $this->put(
            route('announcements.update', $announcement),
            $data
        );

        $data['id'] = $announcement->id;

        $this->assertDatabaseHas('announcements', $data);

        $response->assertRedirect(route('announcements.edit', $announcement));
    }

    /**
     * @test
     */
    public function it_deletes_the_announcement(): void
    {
        $announcement = Announcement::factory()->create();

        $response = $this->delete(
            route('announcements.destroy', $announcement)
        );

        $response->assertRedirect(route('announcements.index'));

        $this->assertModelMissing($announcement);
    }
}
