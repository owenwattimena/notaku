<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\BerandaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/nota', [NotaController::class, 'create'])->name('nota.tambah');
Route::post('/nota', [NotaController::class, 'store'])->name('nota.save');
Route::get('/nota/{id}/item', [NotaController::class, 'item'])->name('nota.item');
Route::get('/nota/{id}', [NotaController::class, 'show'])->name('nota.detail');
Route::delete('/nota/{id}', [NotaController::class, 'delete'])->name('nota.delete');
Route::get('/nota/{id}/ubah', [NotaController::class, 'edit'])->name('nota.edit');
Route::put('/nota/{id}/ubah', [NotaController::class, 'update'])->name('nota.update');
Route::post('/nota/{id}', [NotaController::class, 'addItem'])->name('nota.detail.add');
Route::delete('/nota/item', [NotaController::class, 'destroy'])->name('nota.detail.destroy');
Route::get('/nota/{id}/preview', [NotaController::class, 'preview'])->name('nota.preview');

