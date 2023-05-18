<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ManualPayment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManualPaymentControllerTest extends TestCase
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
    public function it_displays_index_view_with_manual_payments(): void
    {
        $manualPayments = ManualPayment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('manual-payments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.manual_payments.index')
            ->assertViewHas('manualPayments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_manual_payment(): void
    {
        $response = $this->get(route('manual-payments.create'));

        $response->assertOk()->assertViewIs('app.manual_payments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_manual_payment(): void
    {
        $data = ManualPayment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('manual-payments.store'), $data);

        $this->assertDatabaseHas('manual_payments', $data);

        $manualPayment = ManualPayment::latest('id')->first();

        $response->assertRedirect(
            route('manual-payments.edit', $manualPayment)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_manual_payment(): void
    {
        $manualPayment = ManualPayment::factory()->create();

        $response = $this->get(route('manual-payments.show', $manualPayment));

        $response
            ->assertOk()
            ->assertViewIs('app.manual_payments.show')
            ->assertViewHas('manualPayment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_manual_payment(): void
    {
        $manualPayment = ManualPayment::factory()->create();

        $response = $this->get(route('manual-payments.edit', $manualPayment));

        $response
            ->assertOk()
            ->assertViewIs('app.manual_payments.edit')
            ->assertViewHas('manualPayment');
    }

    /**
     * @test
     */
    public function it_updates_the_manual_payment(): void
    {
        $manualPayment = ManualPayment::factory()->create();

        $data = [
            'file_path' => $this->faker->text(),
            'remarks' => $this->faker->text(255),
            'payment_method' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('manual-payments.update', $manualPayment),
            $data
        );

        $data['id'] = $manualPayment->id;

        $this->assertDatabaseHas('manual_payments', $data);

        $response->assertRedirect(
            route('manual-payments.edit', $manualPayment)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_manual_payment(): void
    {
        $manualPayment = ManualPayment::factory()->create();

        $response = $this->delete(
            route('manual-payments.destroy', $manualPayment)
        );

        $response->assertRedirect(route('manual-payments.index'));

        $this->assertModelMissing($manualPayment);
    }
}
