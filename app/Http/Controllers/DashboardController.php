<?php

namespace App\Http\Controllers;

use App\Models\PackingList;
use App\Models\Trip;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTrips = Trip::where('user_id', auth()->id())->count();

        $totalPacking = PackingList::whereHas('trip', function ($query) {
            $query->where('user_id', auth()->id());
        })->count();

        $totalChecked = PackingList::whereHas('trip', function ($query) {
            $query->where('user_id', auth()->id());
        })->where('is_checked', true)->count();

        $packingProgress = $totalPacking > 0 ? round(($totalChecked / $totalPacking) * 100) : 0;

        $latestTrips = Trip::where('user_id', auth()->id())
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'totalTrips',
            'totalPacking',
            'packingProgress',
            'latestTrips'
        ));
    }
}