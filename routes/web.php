<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\WitchController::class, 'index'])->name('witch');
Route::get('getkill', [App\Http\Controllers\WitchController::class, 'prima'])->name('getkill');
Route::post('findkill', [App\Http\Controllers\WitchController::class, 'prima_dinamis'])->name('findkill');