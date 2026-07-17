<?php

namespace App\Http\Controllers;


use App\Models\Trip;
use App\Models\PackingList;
use Illuminate\Http\Request;



class PackingListController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Menampilkan packing berdasarkan trip
    |--------------------------------------------------------------------------
    */


    public function index(Trip $trip)
    {


        $packingLists = $trip
            ->packingLists()
            ->latest()
            ->get();



        return view('packing.index',compact(

            'trip',
            'packingLists'

        ));



    }






    /*
    |--------------------------------------------------------------------------
    | Form tambah barang
    |--------------------------------------------------------------------------
    */


    public function create(Trip $trip)
    {


        return view('packing.create',
            compact('trip')
        );


    }







    /*
    |--------------------------------------------------------------------------
    | Simpan barang
    |--------------------------------------------------------------------------
    */


    public function store(Request $request, Trip $trip)
    {


        $request->validate([


            'item_name'=>'required|string',

            'category'=>'nullable|string',

            'quantity'=>'required|integer'


        ]);




        $trip->packingLists()->create([


            'item_name'=>$request->item_name,

            'category'=>$request->category,

            'quantity'=>$request->quantity,

            'is_checked'=>false


        ]);





        return redirect()

            ->route('packing.index',$trip)

            ->with(
                'success',
                'Barang berhasil ditambahkan'
            );



    }







    /*
    |--------------------------------------------------------------------------
    | Hapus barang
    |--------------------------------------------------------------------------
    */


    public function destroy(PackingList $packing)
    {


        $packing->delete();



        return back()

            ->with(
                'success',
                'Barang berhasil dihapus'
            );


    }



}