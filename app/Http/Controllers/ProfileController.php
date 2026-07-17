<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }



    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }





    public function update(Request $request)
    {

        $user = Auth::user();


        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],


            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],


            'phone' => [
                'nullable',
                'string',
                'max:20'
            ],


            'gender' => [
                'nullable',
                'in:Laki-laki,Perempuan'
            ],


            'birth_date' => [
                'nullable',
                'date'
            ],


            'address' => [
                'nullable',
                'string'
            ]

        ]);



        $user->update([

            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'address' => $validated['address'] ?? null,

        ]);



        return redirect()

            ->route('profile')

            ->with('success','Profile berhasil diperbarui!');

    }


}