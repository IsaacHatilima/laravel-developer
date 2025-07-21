<?php

use App\Http\Controllers\GolferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/golfers', [GolferController::class, 'index'])
    ->name('golfers.index');

Route::get('/golfers/download', [GolferController::class, 'download'])
    ->name('golfers.download');
