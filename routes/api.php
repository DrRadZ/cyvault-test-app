<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IntegrationController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/integrations/alienvault', function (Request $request) {
        return response()->json([
            'url' => 'https://otx.alienvault.com',
            'token' => 'your-token-here'
        ]);
    });

    // Route::post('/alienvault/activities', [IntegrationController::class, 'storeActivities']);
    Route::post('/alienvault/activities', [IntegrationController::class, 'storeActivities'])->middleware('auth:sanctum');
});
