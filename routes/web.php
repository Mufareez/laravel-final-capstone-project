<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\InventoryTrackerController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;



// This function checks if the current route matches the given route(s) and returns 'active' if it does, or an empty string otherwise.
if (!function_exists('set_active')) {
    function set_active($routes, $active = 'active')
    {
        $currentRoute = Route::currentRouteName();

        if (is_array($routes)) {
            return in_array($currentRoute, $routes) ? $active : '';
        }

        return $currentRoute === $routes ? $active : '';
    }
}


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('purchases', PurchaseController::class);
    Route::resource('sales', SaleController::class);
    Route::get('sales-invoice/{id}', [SaleController::class,'invoice'])->name('sales.invoice');
    Route::resource('current-stocks', InventoryTrackerController::class);

});

require __DIR__.'/auth.php';



// or

    // Route::get('/create', [BrandController::class, 'create'])->name('brands.create');
    // Route::get('/', [BrandController::class, 'index'])->name('brands.index');
    // Route::post('/', [BrandController::class, 'store'])->name('brands.store');
    // Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    // Route::put('/{id}', [BrandController::class, 'update'])->name('brands.update');
    // Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
