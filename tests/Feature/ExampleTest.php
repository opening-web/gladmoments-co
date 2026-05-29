<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_booking_page_returns_successful_response(): void
    {
        $response = $this->get('/booking');
        $response->assertStatus(200);
    }

    public function test_gladtocall_page_returns_successful_response(): void
    {
        $response = $this->get('/services/gladtocall');
        $response->assertStatus(200);
        $response->assertSee('Glad to Call');
        $response->assertSee('Tentang');
        $response->assertSee('Layanan');
        $response->assertSee('Pricelist');
        $response->assertSee('Aturan');
    }

    public function test_gladmoments_page_returns_successful_response(): void
    {
        $response = $this->get('/services/gladmoments');
        $response->assertStatus(200);
        $response->assertSee('Glad Moments');
        $response->assertSee('Classic');
        $response->assertSee('Magazine');
        $response->assertSee('Terms');
    }

    public function test_availability_page_returns_404(): void
    {
        $response = $this->get('/availability');
        $response->assertStatus(404);
    }
}
