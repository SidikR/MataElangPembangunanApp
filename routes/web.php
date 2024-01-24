<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\InstansiController;
use App\Http\Controllers\Admin\DesaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/detail', function () {
    return view('pages.dinkes.stunting.detailData');
})->name('detail');

Route::get('/detail/map', function () {
    return view('pages.dinkes.stunting.detaildataMap');
})->name('detail/map');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return view('admin-page.pages.index');
})->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::resource('instansi', InstansiController::class);
    Route::get('trash/instansi', [InstansiController::class, 'trash'])->name('instansi.trash');
    Route::put('instansi/restore/{id}', [InstansiController::class, 'restoreFromTrash'])->name('instansi.restore');
    Route::delete('instansi/permanent-delete/{id}', [InstansiController::class, 'deletePermanently'])->name('instansi.permanent-delete');

    Route::resource('data-kecamatan', KecamatanController::class);
    Route::get('trash/data-kecamatan', [KecamatanController::class, 'trash'])->name('data-kecamatan.trash');
    Route::put('data-kecamatan/restore/{id}', [KecamatanController::class, 'restoreFromTrash'])->name('data-kecamatan.restore');
    Route::delete('data-kecamatan/permanent-delete/{id}', [KecamatanController::class, 'deletePermanently'])->name('data-kecamatan.permanent-delete');

    Route::resource('data-desa', DesaController::class);
    Route::get('trash/data-desa', [DesaController::class, 'trash'])->name('data-desa.trash');
    Route::put('data-desa/restore/{id}', [DesaController::class, 'restoreFromTrash'])->name('data-desa.restore');
    Route::delete('data-desa/permanent-delete/{id}', [DesaController::class, 'deletePermanently'])->name('data-desa.permanent-delete');
});
