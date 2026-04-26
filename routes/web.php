<?php

use Illuminate\Support\Facades\Route;

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



use App\Http\Controllers\KenanganController;

Route::get('/', function () {
    return view('home');
});     

Route::get('/kenangan', [KenanganController::class, 'index']);

Route::get('/tambah', function () {
    return view('kenangan.create');
});
Route::get('/edit/{id}', [KenanganController::class, 'edit']);
Route::post('/update/{id}', [KenanganController::class, 'update']);
Route::get('/hapus/{id}', [KenanganController::class, 'destroy']);

Route::post('/kenangan', [KenanganController::class, 'store']);
Route::post('/komentar/{id}', [KenanganController::class, 'komentar']);
Route::get('/kenangan/{id}', [KenanganController::class, 'show']);
Route::post('/upload/{id}', [KenanganController::class, 'upload']);
Route::get('/media/hapus/{id}', [KenanganController::class, 'hapusMedia']);
Route::get('/komentar/hapus/{id}', [KenanganController::class, 'hapusKomentar']);