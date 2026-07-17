<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Equipment;
use Illuminate\Http\Request;


class TransactionController extends Controller
{

    public function index()
    {

        $transactions = Transaction::with('equipment')->get();


        return view('transactions.index', compact('transactions'));

    }




    public function create()
    {

        $equipment = Equipment::where('status','Available')->get();


        return view('transactions.create', compact('equipment'));

    }





    public function store(Request $request)
    {

        $request->validate([

            'equipment_id'=>'required',
            'borrower'=>'required',
            'borrow_date'=>'required',
            'status'=>'required',

        ]);



        Transaction::create([

            'equipment_id'=>$request->equipment_id,
            'borrower'=>$request->borrower,
            'borrow_date'=>$request->borrow_date,
            'return_date'=>$request->return_date,
            'status'=>$request->status,

        ]);



        return redirect()
            ->route('transactions.index')
            ->with('success','Transaksi berhasil ditambahkan');

    }






    public function edit(string $id)
    {

        $transaction = Transaction::findOrFail($id);

        $equipment = Equipment::all();


        return view('transactions.edit',
        compact(
            'transaction',
            'equipment'
        ));

    }







    public function update(Request $request,string $id)
    {

        $transaction = Transaction::findOrFail($id);



        $transaction->update([

            'equipment_id'=>$request->equipment_id,
            'borrower'=>$request->borrower,
            'borrow_date'=>$request->borrow_date,
            'return_date'=>$request->return_date,
            'status'=>$request->status,

        ]);



        return redirect()
            ->route('transactions.index')
            ->with('success','Transaksi berhasil diperbarui');

    }






    public function destroy(string $id)
    {

        Transaction::findOrFail($id)->delete();


        return redirect()
            ->route('transactions.index')
            ->with('success','Transaksi berhasil dihapus');

    }


}