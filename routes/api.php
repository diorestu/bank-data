<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\NotifyController;
use App\Http\Controllers\API\TransactionController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('select-user', [AuthController::class, 'selectAll']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('update-password', [AuthController::class, 'editPassword']);
    Route::post('upload', [AuthController::class, 'uploadImage']);
    Route::post('edit-profile', [AuthController::class, 'editUser']);
    Route::get('teams/{id}', [AuthController::class, 'teams']);
    Route::get('teams/{id}/detail', [AuthController::class, 'detailTeam']);
    Route::get('notify', [NotifyController::class, 'index']);
    Route::get('notify/{id}', [NotifyController::class, 'detail']);
    Route::post('motor', [TransactionController::class, 'postMotor']);
    Route::post('mobil', [TransactionController::class, 'postMobil']);
    Route::post('cetak', [TransactionController::class, 'cetak']);
    Route::post('transaksi/all', [TransactionController::class, 'getDataTransaction']);
    Route::post('transaksi/{date}/detail', [TransactionController::class, 'getTransactionDetail']);
});
