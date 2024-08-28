<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Guest;

class GuestControllerTest extends TestCase
{
    public function test_returns_empty_response(): void
    {
        $this->get('/api/guests')
            ->assertOk()
            ->assertJson([]);
    }

    public function test_returns_guests(): void
    {
        $guest = Guest::factory()->create();

        $this->get("/api/guests/{$guest->id}")
            ->assertOk()
            ->assertJsonPath('id', $guest->id);
    }

    public function test_returns_guest(): void
    {
        $guest = Guest::factory()->create();

        $this->get("/api/guests/{$guest->id}")
            ->assertOk()
            ->assertJson($guest->toArray());
    }

    public function test_creates_guest(): void
    {
        $guest = Guest::factory()->make()->toArray();

        $this->post('/api/guests', $guest)
            ->assertCreated()
            ->assertJson($guest);
    }

    public function test_updates_guest(): void
    {
        $guest = Guest::factory()->create();

        $this->patch("/api/guests/{$guest->id}", ['first_name' => 'Gio'])
            ->assertOk()
            ->assertJsonPath('first_name', 'Gio');
    }

    public function test_deletes_guest(): void {
        $guest = Guest::factory()->create();

        $this->delete("/api/guests/{$guest->id}")
        ->assertNoContent()
        ->assertContent('');

        $this->assertDatabaseMissing('guests', ['id' => $guest->id]);
    }
}
