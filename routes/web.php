<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\FansController;
 use App\Http\Controllers\admin\FansController;
//use App\Http\Controllers\FansController;
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
    return view('backend.dashboard');
});

Route::get('/create', function () {
    return view('backend.fans.create');
});

///// fans///////////////////////////////////
Route::resource('fans/',FansController::class);


//Route::get('/fanss', [FansController::class, 'index'])->name('fan.index');
//Route::get('/fanss/create', [FansController::class, 'create'])->name('fan.create');
///Route::post('/fanss', [FansController::class, 'store2'])->name('fan.store');
//Route::get('/fanss/{fan}', [FansController::class, 'show'])->name('fan.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
