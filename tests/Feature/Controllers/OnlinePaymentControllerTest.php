<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\OnlinePayment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OnlinePaymentControllerTest extends TestCase
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
    public function it_displays_index_view_with_online_payments(): void
    {
        $onlinePayments = OnlinePayment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('online-payments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.online_payments.index')
            ->assertViewHas('onlinePayments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_online_payment(): void
    {
        $response = $this->get(route('online-payments.create'));

        $response->assertOk()->assertViewIs('app.online_payments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_online_payment(): void
    {
        $data = OnlinePayment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('online-payments.store'), $data);

        $this->assertDatabaseHas('online_payments', $data);

        $onlinePayment = OnlinePayment::latest('id')->first();

        $response->assertRedirect(
            route('online-payments.edit', $onlinePayment)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_online_payment(): void
    {
        $onlinePayment = OnlinePayment::factory()->create();

        $response = $this->get(route('online-payments.show', $onlinePayment));

        $response
            ->assertOk()
            ->assertViewIs('app.online_payments.show')
            ->assertViewHas('onlinePayment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_online_payment(): void
    {
        $onlinePayment = OnlinePayment::factory()->create();

        $response = $this->get(route('online-payments.edit', $onlinePayment));

        $response
            ->assertOk()
            ->assertViewIs('app.online_payments.edit')
            ->assertViewHas('onlinePayment');
    }

    /**
     * @test
     */
    public function it_updates_the_online_payment(): void
    {
        $onlinePayment = OnlinePayment::factory()->create();

        $data = [];

        $response = $this->put(
            route('online-payments.update', $onlinePayment),
            $data
        );

        $data['id'] = $onlinePayment->id;

        $this->assertDatabaseHas('online_payments', $data);

        $response->assertRedirect(
            route('online-payments.edit', $onlinePayment)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_online_payment(): void
    {
        $onlinePayment = OnlinePayment::factory()->create();

        $response = $this->delete(
            route('online-payments.destroy', $onlinePayment)
        );

        $response->assertRedirect(route('online-payments.index'));

        $this->assertModelMissing($onlinePayment);
    }
}
