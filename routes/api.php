<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorDataController;

Route::post('/sensor-data', [SensorDataController::class, 'store']);
Route::get('/sensor-data', [SensorDataController::class, 'index']);