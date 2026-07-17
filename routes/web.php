<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\TransactionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', function () {

    return redirect()->route('dashboard');

});



/*
|--------------------------------------------------------------------------
| Vue Login Page (API Token)
|--------------------------------------------------------------------------
*/


Route::get('/login-vue', function () {

    return Inertia::render('Login');

})->name('login.vue');





Route::middleware(['auth'])->group(function () {



    /*
    |--------------------------------------------------------------------------
    | Dashboard Smart Hub (Inertia Vue)
    |--------------------------------------------------------------------------
    */


    Route::get('/dashboard', function () {


        return Inertia::render('Dashboard', [

            'user' => auth()->user(),


            'totalEquipment' => \App\Models\Equipment::count(),


            'totalCategory' => \App\Models\Category::count(),


            'borrowedEquipment' => \App\Models\Equipment::where(
                'status',
                'Borrowed'
            )->count(),


            'availableEquipment' => \App\Models\Equipment::where(
                'status',
                'Available'
            )->count(),


            'latestEquipment' => \App\Models\Equipment::latest()
                ->take(5)
                ->get(),

        ]);


    })->name('dashboard');






    /*
    |--------------------------------------------------------------------------
    | Category Inertia Vue
    |--------------------------------------------------------------------------
    */


    Route::get('/categories-page', function () {


        return Inertia::render('Categories/Index', [

            'categories' => \App\Models\Category::latest()->get()

        ]);


    })->name('categories.page');







    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */


    Route::get('/profile',
        [ProfileController::class, 'index']
    )->name('profile');



    Route::get('/profile/edit',
        [ProfileController::class, 'edit']
    )->name('profile.edit');



    Route::put('/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');







    /*
    |--------------------------------------------------------------------------
    | Smart Hub Management System
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Data Master Kategori (Blade lama)
    |--------------------------------------------------------------------------
    */


    Route::resource(
        'categories',
        CategoryController::class
    );





    /*
    |--------------------------------------------------------------------------
    | Data Master Peralatan
    |--------------------------------------------------------------------------
    */


    Route::resource(
        'equipment',
        EquipmentController::class
    );





    /*
    |--------------------------------------------------------------------------
    | Manage Transaction
    |--------------------------------------------------------------------------
    */


    Route::resource(
        'transactions',
        TransactionController::class
    );



});





require __DIR__.'/auth.php';