<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\FansController;
use App\Http\Controllers\Admin\FanController;
use App\Http\Controllers\Admin\AbonmentsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PaimntstController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\AppareilController;
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
    return view('auth.login');
});
Route::get('/generate-card-index', [IndexController::class, 'create'])->name('generate.card.index');
Route::post('/generate-card-preview', [IndexController::class, 'index'])->name('generate.card.preview');
Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/create', function () {
    return view('backend.fans.create');
});

///// fans///////////////////////////////////
Route::get('/fans', [FanController::class, 'index'])->name('fans.index');

// فورم إنشاء فان جديد
Route::get('/fans/create', [FanController::class, 'create'])->name('fans.create');

// حفظ فان جديد
Route::post('/fans', [FanController::class, 'store'])->name('fans.store');

// عرض فان واحد بالتفصيل
Route::get('/fans/{fan}', [FanController::class, 'show'])->name('fans.show');

// فورم تعديل فان
Route::get('/fans/{fan}/edit', [FanController::class, 'edit'])->name('fans.edit');

// تحديث بيانات فان
Route::put('/fans/{fan}', [FanController::class, 'update'])->name('fans.update');

// حذف فان
Route::delete('/fans/{fan}', [FanController::class, 'destroy'])->name('fans.destroy');
Route::resource('appareils', AppareilController::class);
Route::resource('abonments', AbonmentsController::class);
Route::resource('events', EventController::class);
Route::resource('Paimnts', PaimntstController::class);
});
//Route::get('/fanss', [FansController::class, 'index'])->name('fan.index');
//Route::get('/fanss/create', [FansController::class, 'create'])->name('fan.create');
///Route::post('/fanss', [FansController::class, 'store2'])->name('fan.store');
//Route::get('/fanss/{fan}', [FansController::class, 'show'])->name('fan.show');

Route::get('/dashboard', function () {
    return view('backend.layouts.master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
