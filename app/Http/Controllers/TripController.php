<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TripController extends Controller
{


    /**
     * Menampilkan semua trip user
     */
    public function index()
    {

        $trips = Trip::where('user_id', Auth::id())
            ->with('packingLists')
            ->latest()
            ->get();


        return view('trips.index', compact('trips'));

    }





    /**
     * Form tambah trip
     */
    public function create()
    {

        return view('trips.create');

    }





    /**
     * Simpan trip baru
     */
    public function store(Request $request)
    {


        $validated = $request->validate([


            'destination_name' => 'required|string|max:255',

            'destination_type' => 'required|string',

            'transportation' => 'required|string',

            'accommodation' => 'required|string',

            'travel_style' => 'required|string',

            'departure_date' => 'required|date',

            'return_date' => 'required|date',

            'has_medication' => 'nullable',

            'notes' => 'nullable|string',


        ]);



        $validated['user_id'] = Auth::id();



        Trip::create($validated);



        return redirect()

            ->route('trips.index')

            ->with(
                'success',
                'Trip berhasil ditambahkan'
            );


    }







    /**
     * Detail trip
     */
    public function show(Trip $trip)
    {

        $trip->load('packingLists');


        return view('trips.show', compact('trip'));

    }







    /**
     * Form edit trip
     */
    public function edit(Trip $trip)
    {


        return view('trips.edit', compact('trip'));

    }







    /**
     * Update trip
     */
    public function update(Request $request, Trip $trip)
    {


        $validated = $request->validate([


            'destination_name' => 'required|string|max:255',

            'destination_type' => 'required|string',

            'transportation' => 'required|string',

            'accommodation' => 'required|string',

            'travel_style' => 'required|string',

            'departure_date' => 'required|date',

            'return_date' => 'required|date',

            'has_medication' => 'nullable',

            'notes' => 'nullable|string',


        ]);




        $trip->update($validated);




        return redirect()

            ->route('trips.index')

            ->with(
                'success',
                'Perjalanan berhasil diperbarui'
            );


    }







    /**
     * Hapus trip
     */
    public function destroy(Trip $trip)
    {


        $trip->delete();



        return redirect()

            ->route('trips.index')

            ->with(
                'success',
                'Trip berhasil dihapus'
            );


    }


}