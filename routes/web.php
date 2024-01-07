<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\CalorieController;
use App\Http\Controllers\FriendController;

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
Route::get('/trainingLog', [CheckController::class, 'recordEndTraining'])->name('home.record-endTraining');
Route::get('/home/index', [WeightController::class, 'show'])->name('weight.show');
Route::patch('/home/weight', [WeightController::class, 'add'])->name('weight.add');
Route::patch('/home/calorie', [CalorieController::class, 'add'])->name('calorie.add');

// map部
Route::get('/map/index', [UserController::class, 'showMap'])->name('map.show');

// shopping部
Route::post('/shopping/index', [UserController::class, 'shopping'])->name('shopping.index');
Route::get('/shopping/index', [UserController::class, 'shopping'])->name('shopping.index');

// friend部
Route::get('/friend/index', [FriendController::class, 'showIndex'])->name('friend.index');
Route::get('/friend/apply', [FriendController::class, 'showApply'])->name('friend.apply');
Route::post('/friend/apply/confirm', [FriendController::class, 'submitConfirmApply'])->name('friend.submitConfirmApply');
Route::get('/friend/apply/confirm', [FriendController::class, 'confirmApply'])->name('friend.confirmApply');
Route::post('/friend/apply/complete', [FriendController::class, 'submitApply'])->name('friend.submitApply');
Route::get('/friend/apply/complete', [FriendController::class, 'completeApply'])->name('friend.completeApply');
Route::get('/friend/applyTo', [FriendController::class, 'applyTo'])->name('friend.applyTo');
Route::get('/friend/applyFrom', [FriendController::class, 'applyFrom'])->name('friend.applyFrom');

require __DIR__.'/auth.php';