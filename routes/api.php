<?php

use App\Http\Controllers\Api\AdvertisementController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource("advertisements", AdvertisementController::class);