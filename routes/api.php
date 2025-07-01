<?php

use App\Http\Controllers\ApiBrandController;
use Illuminate\Support\Facades\Route;



Route::ApiResource('brands', ApiBrandController::class);

// or

    // Route::get('/index', [BrandController::class, 'index'])->name('brands.index');
    // Route::post('/', [BrandController::class, 'store'])->name('brands.store');
    // Route::get('/{id}', [BrandController::class, 'show'])->name('brands.show');
    // Route::put('/{id}', [BrandController::class, 'update'])->name('brands.update');
    // Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');

