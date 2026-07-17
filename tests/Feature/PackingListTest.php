<?php

use App\Models\PackingList;
use App\Models\Trip;
use App\Models\User;

test('packing list can be generated for a trip', function () {
    $user = User::factory()->create();
    $trip = Trip::factory()->create([
        'user_id' => $user->id,
        'destination_type' => 'pantai',
        'transportation' => 'pesawat',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $this->actingAs($user);

    $response = $this->post("/trips/{$trip->id}/generate");

    $response->assertRedirect('/trips');

    $this->assertDatabaseHas('packing_lists', [
        'trip_id' => $trip->id,
        'item_name' => 'Kaos',
    ]);

    $this->assertDatabaseHas('packing_lists', [
        'trip_id' => $trip->id,
        'item_name' => 'Sunscreen',
    ]);
});

test('generating packing list replaces old items', function () {
    $user = User::factory()->create();
    $trip = Trip::factory()->create([
        'user_id' => $user->id,
        'destination_type' => 'pantai',
        'transportation' => 'pesawat',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    PackingList::create([
        'trip_id' => $trip->id,
        'item_name' => 'Old Item',
        'category' => 'perlengkapan',
        'quantity' => 1,
        'is_checked' => true,
    ]);

    $this->actingAs($user);

    $this->post("/trips/{$trip->id}/generate");

    $this->assertDatabaseMissing('packing_lists', [
        'trip_id' => $trip->id,
        'item_name' => 'Old Item',
    ]);

    $this->assertDatabaseHas('packing_lists', [
        'trip_id' => $trip->id,
        'item_name' => 'Kaos',
    ]);
});

test('user cannot generate packing list for other users trip', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $trip = Trip::factory()->create([
        'user_id' => $otherUser->id,
        'destination_type' => 'pantai',
        'transportation' => 'pesawat',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $this->actingAs($user);

    $response = $this->post("/trips/{$trip->id}/generate");

    $response->assertStatus(403);
});

test('packing item can be toggled', function () {
    $user = User::factory()->create();
    $trip = Trip::factory()->create(['user_id' => $user->id]);
    $item = PackingList::factory()->create([
        'trip_id' => $trip->id,
        'is_checked' => false,
    ]);

    $this->actingAs($user);

    $response = $this->post("/packing-lists/{$item->id}/check");

    $response->assertRedirect();

    $this->assertDatabaseHas('packing_lists', [
        'id' => $item->id,
        'is_checked' => true,
    ]);
});

test('user cannot toggle other users packing item', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $trip = Trip::factory()->create(['user_id' => $otherUser->id]);
    $item = PackingList::factory()->create([
        'trip_id' => $trip->id,
        'is_checked' => false,
    ]);

    $this->actingAs($user);

    $response = $this->post("/packing-lists/{$item->id}/check");

    $response->assertStatus(403);

    $this->assertDatabaseHas('packing_lists', [
        'id' => $item->id,
        'is_checked' => false,
    ]);
});

test('packing list items are displayed on trips page', function () {
    $user = User::factory()->create();
    $trip = Trip::factory()->create(['user_id' => $user->id]);
    PackingList::factory()->create([
        'trip_id' => $trip->id,
        'item_name' => 'Kaos',
        'category' => 'pakaian',
        'quantity' => 3,
        'is_checked' => false,
    ]);

    $this->actingAs($user);

    $response = $this->get('/trips');

    $response->assertSee('Kaos');
    $response->assertSee('Pakaian');
});
