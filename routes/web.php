<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

// // BASIC ROUTE 
// Route::get('/', [HomeController::class, 'index']);

// // PREFIX ROUTE
// Route::prefix('category')->group(function () {
//     Route::get('/food-beverage', [ProductsController::class, 'foodBeverage']);
//     Route::get('/beauty-health', [ProductsController::class, 'beautyHealth']);
//     Route::get('/home-care', [ProductsController::class, 'homeCare']);
//     Route::get('/baby-kid', [ProductsController::class, 'babyKid']);
// });

// // ROUTES PARAMS
// Route::get('/user/{id}/name/{name}', [UserController::class, 'index']);

// // BASIC ROUTE
// Route::get('/penjualan', [PenjualanController::class, 'index']);

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);

// Route::get('/user', [UserController::class, 'index']);

// Route::get('/user/tambah', [UserController::class, 'tambah']);

// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::prefix('/kategori')->group(function () {
	Route::get('/', [KategoriController::class, 'index'])->name('/kategori');
	Route::get('/create', [KategoriController::class, 'create'])->name('/kategori/create');
	Route::post('/', [KategoriController::class, 'store']);
	Route::get('/update/{id}', [KategoriController::class, 'update'])->name('/kategori/update');
	Route::put('/update_simpan/{id}', [KategoriController::class, 'update_simpan'])->name('/kategori/update_simpan');
	Route::get('/hapus/{id}', [KategoriController::class, 'hapus'])->name('/kategori/hapus');
});
