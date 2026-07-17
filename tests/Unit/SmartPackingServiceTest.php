<?php

use App\Services\SmartPackingService;

test('generates base items for any trip', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'pantai',
        'transportation' => 'mobil',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $itemNames = array_column($items, 'item_name');

    expect($itemNames)->toContain('Kaos');
    expect($itemNames)->toContain('Celana');
    expect($itemNames)->toContain('Pakaian Dalam');
    expect($itemNames)->toContain('Charger HP');
    expect($itemNames)->toContain('Perlengkapan Mandi');
});

test('calculates quantity based on trip duration', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'kota',
        'transportation' => 'mobil',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $kaos = collect($items)->firstWhere('item_name', 'Kaos');
    $celana = collect($items)->firstWhere('item_name', 'Celana');
    $dalam = collect($items)->firstWhere('item_name', 'Pakaian Dalam');

    expect($kaos['quantity'])->toBe(4); // 3 days + 1
    expect($celana['quantity'])->toBe(3); // 3 days
    expect($dalam['quantity'])->toBe(4); // 3 days + 1
});

test('adds beach items for pantai destination', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'pantai',
        'transportation' => 'mobil',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $itemNames = array_column($items, 'item_name');

    expect($itemNames)->toContain('Sunscreen');
    expect($itemNames)->toContain('Sandal');
    expect($itemNames)->toContain('Topi');
    expect($itemNames)->toContain('Pakaian Renang');
});

test('adds mountain items for gunung destination', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'gunung',
        'transportation' => 'mobil',
        'accommodation' => 'camping',
        'travel_style' => 'backpacker',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $itemNames = array_column($items, 'item_name');

    expect($itemNames)->toContain('Jaket');
    expect($itemNames)->toContain('Sepatu Hiking');
    expect($itemNames)->toContain('Jas Hujan');
    expect($itemNames)->toContain('Senter');
});

test('adds city items for kota destination', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'kota',
        'transportation' => 'mobil',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $itemNames = array_column($items, 'item_name');

    expect($itemNames)->toContain('Payung');
    expect($itemNames)->toContain('Tas Kecil');
});

test('adds flight items for pesawat transportation', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'pantai',
        'transportation' => 'pesawat',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $itemNames = array_column($items, 'item_name');

    expect($itemNames)->toContain('Koper');
    expect($itemNames)->toContain('KTP/Paspor');
});

test('adds boat items for kapal transportation', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'pantai',
        'transportation' => 'kapal',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $itemNames = array_column($items, 'item_name');

    expect($itemNames)->toContain('Obat Mabuk Laut');
    expect($itemNames)->toContain('Tas Anti Air');
});

test('adds camping items for camping accommodation', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'gunung',
        'transportation' => 'mobil',
        'accommodation' => 'camping',
        'travel_style' => 'backpacker',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $itemNames = array_column($items, 'item_name');

    expect($itemNames)->toContain('Sleeping Bag');
    expect($itemNames)->toContain('Tenda');
    expect($itemNames)->toContain('Matras');
});

test('adds backpacker items for backpacker style', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'pantai',
        'transportation' => 'mobil',
        'accommodation' => 'hotel',
        'travel_style' => 'backpacker',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $itemNames = array_column($items, 'item_name');

    expect($itemNames)->toContain('Makanan Instan');
    expect($itemNames)->toContain('Snack');
    expect($itemNames)->toContain('Air Minum');
    expect($itemNames)->toContain('Power Bank');
});

test('adds medication items when has_medication is true', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'kota',
        'transportation' => 'mobil',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => true,
    ]);

    $itemNames = array_column($items, 'item_name');

    expect($itemNames)->toContain('Obat Pribadi');
    expect($itemNames)->toContain('P3K');
});

test('does not add medication items when has_medication is false', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'kota',
        'transportation' => 'mobil',
        'accommodation' => 'hotel',
        'travel_style' => 'regular',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-12',
        'has_medication' => false,
    ]);

    $itemNames = array_column($items, 'item_name');

    expect($itemNames)->not->toContain('Obat Pribadi');
    expect($itemNames)->not->toContain('P3K');
});

test('all items have valid categories', function () {
    $service = new SmartPackingService();

    $items = $service->generate([
        'destination_type' => 'pantai',
        'transportation' => 'pesawat',
        'accommodation' => 'camping',
        'travel_style' => 'backpacker',
        'departure_date' => '2026-07-10',
        'return_date' => '2026-07-15',
        'has_medication' => true,
    ]);

    $validCategories = ['pakaian', 'perlengkapan', 'dokumen', 'obat', 'makanan'];

    foreach ($items as $item) {
        expect($item['category'])->toBeIn($validCategories);
        expect($item['item_name'])->not->toBeEmpty();
        expect($item['quantity'])->toBeGreaterThan(0);
    }
});
