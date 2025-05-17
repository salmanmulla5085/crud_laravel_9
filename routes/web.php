<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
})->middleware('user');


Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->middleware('admin')->name('admin.dashboard');
Route::get('/user/dashboard', fn() => view('user.dashboard'))->middleware('user')->name('user.dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['user'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/users/list', [UserController::class, 'getUsers']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'edit']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});
