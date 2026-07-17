<?php

use App\Models\Trip;
use App\Models\User;

test('trips page requires authentication', function () {
    $this->get('/trips')->assertRedirect('/login');
});

test('authenticated user can view trips page', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->get('/trips')->assertOk();
});

test('authenticated user can create a trip', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->post('/trips', [
        'destination_name' => 'Bali',
        'destination_type' => 'pantai',
        'transportation' => 'pesawat',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-08-01',
        'return_date' => '2026-08-05',
    ]);

    $response->assertRedirect('/trips');

    $this->assertDatabaseHas('trips', [
        'user_id' => $user->id,
        'destination_name' => 'Bali',
        'destination_type' => 'pantai',
    ]);
});

test('trip validation requires destination name', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->post('/trips', [
        'destination_name' => '',
        'destination_type' => 'pantai',
        'transportation' => 'pesawat',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-08-01',
        'return_date' => '2026-08-05',
    ]);

    $response->assertSessionHasErrors('destination_name');
});

test('authenticated user can edit a trip', function () {
    $user = User::factory()->create();
    $trip = Trip::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    $response = $this->put("/trips/{$trip->id}", [
        'destination_name' => 'Bandung',
        'destination_type' => 'gunung',
        'transportation' => 'mobil',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-08-01',
        'return_date' => '2026-08-05',
    ]);

    $response->assertRedirect('/trips');

    $this->assertDatabaseHas('trips', [
        'id' => $trip->id,
        'destination_name' => 'Bandung',
    ]);
});

test('user cannot edit other users trip', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $trip = Trip::factory()->create(['user_id' => $otherUser->id]);

    $this->actingAs($user);

    $response = $this->put("/trips/{$trip->id}", [
        'destination_name' => 'Hacked',
        'destination_type' => 'kota',
        'transportation' => 'mobil',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-08-01',
        'return_date' => '2026-08-05',
    ]);

    $response->assertStatus(403);
});

test('authenticated user can delete a trip', function () {
    $user = User::factory()->create();
    $trip = Trip::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    $response = $this->delete("/trips/{$trip->id}");

    $response->assertRedirect('/trips');

    $this->assertDatabaseMissing('trips', ['id' => $trip->id]);
});

test('user cannot delete other users trip', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $trip = Trip::factory()->create(['user_id' => $otherUser->id]);

    $this->actingAs($user);

    $response = $this->delete("/trips/{$trip->id}");

    $response->assertStatus(403);

    $this->assertDatabaseHas('trips', ['id' => $trip->id]);
});
