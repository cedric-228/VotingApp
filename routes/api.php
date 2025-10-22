<?php

use App\Http\Controllers\Api\CandidateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ROUTE TEST SIMPLE - SANS BASE DE DONNÉES
Route::get('/test-simple', function() {
    return response()->json([
        'status' => 'success',
        'message' => 'API Laravel fonctionne',
        'timestamp' => now()
    ]);
});

// Le reste de vos routes...
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('candidates', CandidateController::class);

Route::get('/test-model', function() {
    try {
        $candidates = \App\Models\Candidate::all();
        return response()->json(['count' => $candidates->count()]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});