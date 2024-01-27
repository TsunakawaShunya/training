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
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/training/index', [MenuController::class, 'showIndex'])->name('training-index.show');
    Route::get('/training/menu/{part}', [MenuController::class, 'showMenu'])->name('menu.show');
    Route::post('/training/menu/add', [MenuController::class, 'storeMenu'])->name('menu.store');
    Route::post('/training/menu/delete', [MenuController::class, 'deleteMenu'])->name('menu.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/training/menu/{part}/start', [CheckController::class, 'showStart'])->name('training-start.show');
    Route::post('/training/menu/{part}/start', [CheckController::class, 'postStart'])->name('training-start.post');
    Route::get('/training/menu/{part}/end', [CheckController::class, 'showEnd'])->name('training-end.show');
    Route::post('/training/menu/{part}/end', [CheckController::class, 'postEnd'])->name('training-end.post');
    Route::get('/trainingLog', [CheckController::class, 'recordEndTraining'])->name('home.record-endTraining');
});

Route::middleware('auth')->group(function () {
    Route::get('/training/post', [PostController::class, 'trainingPostShow'])->name('training.post.show');
    Route::post('/training/post/post', [PostController::class, 'postPost'])->name('post.post');
    Route::get('/friend/post', [PostController::class, 'normalPostShow'])->name('friend.post.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/home/index', [WeightController::class, 'show'])->name('weight.show');
    Route::patch('/home/weight', [WeightController::class, 'add'])->name('weight.add');
});

Route::middleware('auth')->group(function () {
    Route::get('/map/index', [UserController::class, 'showMap'])->name('map.show');
    Route::post('/shopping/index', [UserController::class, 'shopping'])->name('shopping.index');
    Route::get('/shopping/index', [UserController::class, 'shopping'])->name('shopping.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/friend/index', [FriendController::class, 'showIndex'])->name('friend.index');
    Route::get('/friend/list', [FriendController::class, 'showList'])->name('friend.list');
    Route::get('/friend/apply', [FriendController::class, 'showApply'])->name('friend.apply');
    Route::post('/friend/apply/confirm', [FriendController::class, 'submitConfirmApply'])->name('friend.submitConfirmApply');
    Route::get('/friend/apply/confirm', [FriendController::class, 'confirmApply'])->name('friend.confirmApply');
    Route::post('/friend/apply/complete', [FriendController::class, 'submitApply'])->name('friend.submitApply');
    Route::get('/friend/apply/complete', [FriendController::class, 'completeApply'])->name('friend.completeApply');
    Route::get('/friend/applyTo', [FriendController::class, 'applyTo'])->name('friend.applyTo');
    Route::patch('/friend/applyTo/cancel', [FriendController::class, 'cancelApplyTo'])->name('friend.cancelApplyTo');
    Route::get('/friend/applyFrom', [FriendController::class, 'applyFrom'])->name('friend.applyFrom');
});

Route::middleware('auth')->group(function () {
    Route::post('/training/part/add', [PartController::class, 'storePart'])->name('training-part.post');
    Route::post('/training/part/delete', [PartController::class, 'deletePart'])->name('training-part.delete');
});

Route::patch('/home/calorie', [CalorieController::class, 'add'])->name('calorie.add')->middleware('auth');

Route::post('/friend/post/like', [LikeController::class, 'addLike'])->name('friend.addLike')->middleware('auth');

require __DIR__.'/auth.php';