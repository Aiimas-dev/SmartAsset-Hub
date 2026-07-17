<?php

namespace App\Services;

class SmartPackingService
{
    public function generate(array $tripData): array
    {
        $items = [];

        // Hitung durasi
        $days = (
            strtotime($tripData['return_date']) -
            strtotime($tripData['departure_date'])
        ) / 86400 + 1;

        // Barang wajib
        $items[] = [
            'item_name' => 'Kaos',
            'category' => 'pakaian',
            'quantity' => $days + 1,
        ];

        $items[] = [
            'item_name' => 'Celana',
            'category' => 'pakaian',
            'quantity' => $days,
        ];

        $items[] = [
            'item_name' => 'Pakaian Dalam',
            'category' => 'pakaian',
            'quantity' => $days + 1,
        ];

        $items[] = [
            'item_name' => 'Charger HP',
            'category' => 'perlengkapan',
            'quantity' => 1,
        ];

        $items[] = [
            'item_name' => 'Perlengkapan Mandi',
            'category' => 'perlengkapan',
            'quantity' => 1,
        ];

        // Destinasi
        if ($tripData['destination_type'] === 'pantai') {
            $items[] = ['item_name' => 'Sunscreen', 'category' => 'perlengkapan', 'quantity' => 1];
            $items[] = ['item_name' => 'Sandal', 'category' => 'perlengkapan', 'quantity' => 1];
            $items[] = ['item_name' => 'Topi', 'category' => 'perlengkapan', 'quantity' => 1];
            $items[] = ['item_name' => 'Pakaian Renang', 'category' => 'pakaian', 'quantity' => 1];
        }

        if ($tripData['destination_type'] === 'gunung') {
            $items[] = ['item_name' => 'Jaket', 'category' => 'pakaian', 'quantity' => 1];
            $items[] = ['item_name' => 'Sepatu Hiking', 'category' => 'perlengkapan', 'quantity' => 1];
            $items[] = ['item_name' => 'Jas Hujan', 'category' => 'perlengkapan', 'quantity' => 1];
            $items[] = ['item_name' => 'Senter', 'category' => 'perlengkapan', 'quantity' => 1];
        }

        if ($tripData['destination_type'] === 'kota') {
            $items[] = ['item_name' => 'Payung', 'category' => 'perlengkapan', 'quantity' => 1];
            $items[] = ['item_name' => 'Tas Kecil', 'category' => 'perlengkapan', 'quantity' => 1];
        }

        // Transportasi
        if ($tripData['transportation'] === 'pesawat') {
            $items[] = ['item_name' => 'Koper', 'category' => 'perlengkapan', 'quantity' => 1];
            $items[] = ['item_name' => 'KTP/Paspor', 'category' => 'dokumen', 'quantity' => 1];
        }

        if ($tripData['transportation'] === 'kapal') {
            $items[] = ['item_name' => 'Obat Mabuk Laut', 'category' => 'obat', 'quantity' => 1];
            $items[] = ['item_name' => 'Tas Anti Air', 'category' => 'perlengkapan', 'quantity' => 1];
        }

        // Akomodasi
        if ($tripData['accommodation'] === 'camping') {
            $items[] = ['item_name' => 'Sleeping Bag', 'category' => 'perlengkapan', 'quantity' => 1];
            $items[] = ['item_name' => 'Tenda', 'category' => 'perlengkapan', 'quantity' => 1];
            $items[] = ['item_name' => 'Matras', 'category' => 'perlengkapan', 'quantity' => 1];
        }

        // Gaya perjalanan
        if ($tripData['travel_style'] === 'backpacker') {
            $items[] = ['item_name' => 'Makanan Instan', 'category' => 'makanan', 'quantity' => 3];
            $items[] = ['item_name' => 'Snack', 'category' => 'makanan', 'quantity' => 3];
            $items[] = ['item_name' => 'Air Minum', 'category' => 'makanan', 'quantity' => 2];
            $items[] = ['item_name' => 'Power Bank', 'category' => 'perlengkapan', 'quantity' => 1];
        }

        if ($tripData['travel_style'] === 'regular') {
            $items[] = ['item_name' => 'Snack', 'category' => 'makanan', 'quantity' => 2];
            $items[] = ['item_name' => 'Air Minum', 'category' => 'makanan', 'quantity' => 2];
        }

        // Obat pribadi
        if ($tripData['has_medication']) {
            $items[] = ['item_name' => 'Obat Pribadi', 'category' => 'obat', 'quantity' => 1];
            $items[] = ['item_name' => 'P3K', 'category' => 'obat', 'quantity' => 1];
        }

        return $items;
    }
}