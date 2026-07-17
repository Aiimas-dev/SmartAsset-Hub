<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{


    public function index()
    {

        return response()->json([

            'data' => Category::latest()->get()

        ]);

    }





    public function store(Request $request)
    {


        $request->validate([

            'name'=>'required|max:100'

        ]);



        $category = Category::create([

            'name'=>$request->name

        ]);



        return response()->json([

            'message'=>'Kategori berhasil ditambahkan',

            'data'=>$category

        ],201);


    }





    public function destroy(Category $category)
    {


        $category->delete();



        return response()->json([

            'message'=>'Kategori berhasil dihapus'

        ]);


    }


}