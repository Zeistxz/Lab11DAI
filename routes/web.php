<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BranchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('home');
})->name('home');

// need laravel/ui
// Auth::routes();

/*
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
*/
// agregar rutas de autenticación sin usar auth
Route::post('/login', [UserController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('admin');
    // ruta para admin
    Route::get('/create', [UserController::class, 'create'])->name('admin.create');
    Route::post('/store', [UserController::class, 'store'])->name('admin.store');
    // ruta para customers crud
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    // Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
    // Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customers.show');
    // Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    // ruta para vehicles crud
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    // Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles/store', [VehicleController::class, 'store'])->name('vehicles.store');
    // Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');
    // Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
    // ruta para branches  crud
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    // Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/branches/store', [BranchController::class, 'store'])->name('branches.store');
    // Route::get('/branches/{id}', [BranchController::class, 'show'])->name('branches.show');
    // Route::get('/branches/{id}/edit', [BranchController::class, 'edit'])->name('branches.edit');
    Route::put('/branches/{id}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/branches/{id}', [BranchController::class, 'destroy'])->name('branches.destroy');
    
});
