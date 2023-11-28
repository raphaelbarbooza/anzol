<?php

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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Public route for capture
 */
Route::any('/capture/{origin}',[\App\Http\Controllers\RequestController::class,'capture'])->name('capture');

Route::get('/images/{image}',[\App\Http\Controllers\RequestController::class,'getImage'])->name('image');
