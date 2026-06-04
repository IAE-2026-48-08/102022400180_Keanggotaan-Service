<?php

use App\Http\Controllers\MemberController;
use App\Http\Middleware\CheckApiKey;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckApiKey::class])->prefix('v1')->group(function () {
    Route::get('/members/{id}', [MemberController::class, 'show']);
    Route::get('/members/{id}/status', [MemberController::class, 'status']);
    Route::post('/members', [MemberController::class, 'store']);
});