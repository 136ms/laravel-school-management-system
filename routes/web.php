<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');

Route::resource('subjects', App\Http\Controllers\SubjectController::class);

Route::resource('users', App\Http\Controllers\UserController::class);

Route::resource('groups', App\Http\Controllers\GroupController::class);