<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Category;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::with('category')->get();

        return view('equipment.index', compact('equipment'));
    }


    public function create()
    {
        $categories = Category::all();

        return view('equipment.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'code' => 'required|unique:equipment',
            'stock' => 'required|integer',
            'status' => 'required',
        ]);


        Equipment::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'code' => $request->code,
            'stock' => $request->stock,
            'status' => $request->status,
            'description' => $request->description,
        ]);


        return redirect()
            ->route('equipment.index')
            ->with('success', 'Data peralatan berhasil ditambahkan');
    }


    public function edit(string $id)
    {
        $equipment = Equipment::findOrFail($id);
        $categories = Category::all();

        return view('equipment.edit', compact(
            'equipment',
            'categories'
        ));
    }


    public function update(Request $request, string $id)
    {
        $equipment = Equipment::findOrFail($id);


        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'stock' => 'required|integer',
            'status' => 'required',
        ]);


        $equipment->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'code' => $request->code,
            'stock' => $request->stock,
            'status' => $request->status,
            'description' => $request->description,
        ]);


        return redirect()
            ->route('equipment.index')
            ->with('success','Data peralatan berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        Equipment::findOrFail($id)->delete();


        return redirect()
            ->route('equipment.index')
            ->with('success','Data peralatan berhasil dihapus');
    }
}