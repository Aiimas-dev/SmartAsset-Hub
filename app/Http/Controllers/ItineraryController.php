<?php

namespace App\Http\Controllers;


use App\Models\Trip;
use App\Models\Itinerary;
use Illuminate\Http\Request;



class ItineraryController extends Controller
{


    public function index()
    {

        $itineraries = Itinerary::with('trip')
            ->latest()
            ->get();


        return view('itinerary.index', compact('itineraries'));

    }





    public function create()
    {

        $trips = Trip::all();


        return view('itinerary.create', compact('trips'));

    }




    public function store(Request $request)
    {


        $request->validate([

            'trip_id'=>'required',
            'tanggal'=>'required',
            'kegiatan'=>'required',

        ]);



        Itinerary::create($request->all());



        return redirect()
            ->route('itinerary.index')
            ->with('success','Jadwal berhasil ditambahkan');

    }





    public function destroy(Itinerary $itinerary)
    {

        $itinerary->delete();


        return back();

    }


}