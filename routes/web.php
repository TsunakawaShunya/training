<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CheckController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/start-training', [MenuController::class, 'show'])->name('menu.show');
Route::get('/start-training/{part}', [MenuController::class, 'add'])->name('menu.add');
Route::post('/start-training', [MenuController::class, 'store'])->name('menu.store');
Route::post('/training', [CheckController::class, 'check'])->name('menu.check');
Route::get('/training', [CheckController::class, 'check_training'])->name('menu.check_training');

require __DIR__.'/auth.php';