<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [RegisterController::class, '__invoke'])->name('register');
Route::post('/register1', [RegisterController::class, '__invoke'])->name('register1');
Route::post('/barangs1', [BarangController::class, '__invoke'])->name('barangs1');

Route::post('/login', LoginController::class)->name('login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/logout', [LogoutController::class, '__invoke'])->name('logout');

Route::group(['prefix' => 'levels'], function () {
    Route::get('/', [LevelController::class, 'index']);
    Route::post('/', [LevelController::class, 'store']);
    Route::get('/{level}', [LevelController::class, 'show']);
    Route::put('/{level}', [LevelController::class, 'update']);
    Route::delete('/{level}', [LevelController::class, 'destroy']);
});

Route::group(['prefix' => 'kategoris'], function () {
    Route::get('/', [KategoriController::class, 'indexApi']);
    Route::post('/', [KategoriController::class, 'storeApi']);
    Route::get('/{kategori}', [KategoriController::class, 'showApi']);
    Route::put('/{kategori}', [KategoriController::class, 'updateApi']);
    Route::delete('/{kategori}', [KategoriController::class, 'destroyApi']);
});

Route::group(['prefix' => 'barangs'], function () {
    Route::get('/', [BarangController::class, 'indexApi']);
    Route::post('/', [BarangController::class, 'storeApi']);
    Route::get('/{barang}', [BarangController::class, 'showApi']);
    Route::put('/{barang}', [BarangController::class, 'updateApi']);
    Route::delete('/{barang}', [BarangController::class, 'destroyApi']);
});

Route::group(['prefix'=> 'users'], function () {
    Route::get('/', [UserController::class, 'indexApi']);
    Route::post('/', [UserController::class, 'storeApi']);
    Route::get('/{user}', [UserController::class, 'showApi']);
    Route::put('/{user}', [UserController::class, 'updateApi']);
    Route::delete('/{user}', [UserController::class, 'destroyApi']);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
