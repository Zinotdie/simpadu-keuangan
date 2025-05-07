<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisTagihanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KeringananController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Jenis Tagihan Routes
Route::apiResource('jenis-tagihan', JenisTagihanController::class);

// Tahun Ajaran Routes
Route::apiResource('tahun-ajaran', TahunAjaranController::class);
Route::post('tahun-ajaran/{id}/set-aktif', [TahunAjaranController::class, 'setAktif']);

// Tagihan Routes
Route::apiResource('tagihan', TagihanController::class);
Route::get('tagihan/nim/{nim}', [TagihanController::class, 'byNim']);
Route::post('tagihan/{id}/update-status', [TagihanController::class, 'updateStatus']);

// Pembayaran Routes
Route::apiResource('pembayaran', PembayaranController::class);
Route::get('pembayaran/nim/{nim}', [PembayaranController::class, 'byNim']);
Route::get('pembayaran/tagihan/{idTagihan}', [PembayaranController::class, 'byTagihan']);

// Keringanan Routes
Route::apiResource('keringanan', KeringananController::class);
Route::get('keringanan/nim/{nim}', [KeringananController::class, 'byNim']);
Route::post('keringanan/{id}/update-status', [KeringananController::class, 'updateStatus']);