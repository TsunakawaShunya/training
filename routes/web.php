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

Route::get('/training/index', [MenuController::class, 'show'])->name('menu.show');
Route::get('/training/menu/{part}', [MenuController::class, 'add'])->name('menu.add');
Route::post('/training/index', [MenuController::class, 'store'])->name('menu.store');
Route::get('/training/menu/{part}/start', [CheckController::class, 'showStart'])->name('training-start.show');
Route::post('/training/menu/{part}/start', [CheckController::class, 'postStart'])->name('training-start.post');
Route::get('/training/menu/{part}/end', [CheckController::class, 'showEnd'])->name('training-end.show');
Route::post('/training/menu/{part}/end', [CheckController::class, 'postEnd'])->name('training-end.post');

require __DIR__.'/auth.php';