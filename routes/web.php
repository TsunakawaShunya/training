<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeightController;

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

// training部
Route::get('/training/index', [MenuController::class, 'show'])->name('menu.show');
Route::get('/training/menu/{part}', [MenuController::class, 'add'])->name('menu.add');
Route::post('/training/index', [MenuController::class, 'store'])->name('menu.store');
Route::get('/training/menu/{part}/start', [CheckController::class, 'showStart'])->name('training-start.show');
Route::post('/training/menu/{part}/start', [CheckController::class, 'postStart'])->name('training-start.post');
Route::get('/training/menu/{part}/end', [CheckController::class, 'showEnd'])->name('training-end.show');
Route::post('/training/menu/{part}/end', [CheckController::class, 'postEnd'])->name('training-end.post');

// home部
Route::get('/home/index', [WeightController::class, 'show'])->name('home.show');
Route::patch('/home/index', [WeightController::class, 'add'])->name('weight.add');
Route::get('/trainingLog', [CheckController::class, 'recordEndTraining'])->name('home.record-endTraining');

// shopping部
Route::post('/shopping/index', [UserController::class, 'shopping'])->name('shopping.index');
Route::get('/shopping/index', [UserController::class, 'shopping'])->name('shopping.index');

require __DIR__.'/auth.php';