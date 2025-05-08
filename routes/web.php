<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DeviceController;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','role:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    // Tambahkan route untuk user management
    Route::resource('users', UserController::class);
    Route::get('/admin/dashboard', [ProductController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [ProductController::class, 'index'])->name('admin.dashboard');
    // route admin lainnya
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // Dashboard User
    Route::get('/user/dashboard', function () {
        $user = Auth::user();
        $devices = $user->devices()->with(['readings' => function($query) {
            $query->latest()->limit(5);
        }])->get();
        
        $latestReadings = $user->sensorReadings()
                              ->with('device')
                              ->latest()
                              ->take(5)
                              ->get();
        
        return view('user.dashboard', [
            'devices' => $devices,
            'latestReadings' => $latestReadings
        ]);
    })->name('user.dashboard');
    
    
    
    // Device Management
    Route::resource('devices', DeviceController::class);
    
    
});



require __DIR__.'/auth.php';
