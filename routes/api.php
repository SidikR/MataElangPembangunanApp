<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Api\InstansiApiController;
use App\Http\Controllers\Admin\Api\KecamatanApiController;
use App\Http\Controllers\Admin\Api\DesaApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('instansi', InstansiApiController::class);
Route::get('/trash/instansi', [InstansiApiController::class, 'trash'])->name('instansi.trash');
Route::put('/instansi/restore/{id}', [InstansiApiController::class, 'restoreFromTrash'])->name('instansi.restore');
Route::delete('/instansi/permanent-delete/{id}', [InstansiApiController::class, 'deletePermanently'])->name('instansi.permanent-delete');

Route::apiResource('data-kecamatan', KecamatanApiController::class);
Route::get('/trash/data-kecamatan', [KecamatanApiController::class, 'trash'])->name('data-kecamatan.trash');
Route::put('/data-kecamatan/restore/{id}', [KecamatanApiController::class, 'restoreFromTrash'])->name('data-kecamatan.restore');
Route::delete('/data-kecamatan/permanent-delete/{id_kecamatan}', [KecamatanApiController::class, 'deletePermanently'])->name('data-kecamatan.permanent-delete');

Route::apiResource('data-desa', DesaApiController::class);
Route::get('/data-desa-by-kecamatan', [DesaApiController::class, 'getByKecamatan'])->name('data-desa.getByKecamatan');
Route::get('/trash/data-desa', [DesaApiController::class, 'trash'])->name('data-desa.trash');
Route::put('/data-desa/restore/{id}', [DesaApiController::class, 'restoreFromTrash'])->name('data-desa.restore');
Route::delete('/data-desa/permanent-delete/{id_desa}', [DesaApiController::class, 'deletePermanently'])->name('data-desa.permanent-delete');
