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
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\dashboardController;
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
    return view('frontend.index');
});

Route::get('/fans/{fan}/cardtelecharger', [FanController::class, 'cardPdftelecharger'])
->name('fans.cardPdftelecharger');
Route::get('/generate-card-index', [IndexController::class, 'create'])->name('generate.card.index');
Route::post('/generate-card-preview', [IndexController::class, 'index'])->name('generate.card.preview');





///////////// adlin////////////////////
Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/create', function () {
    return view('backend.fans.create');
});

///// fans///////////////////////////////////
Route::get('/fans', [FanController::class, 'index'])->name('fans.index');
//Route::post('mceefans/{id}/regenerate', [FanController::class, 'regenerate']);
// web.php
Route::post('fans/{id}/regenerate', [FanController::class, 'regenerate'])->name('fans.regenerate');
Route::post('/fans/toggle-status/{id}', [App\Http\Controllers\Admin\FanController::class, 'toggleStatus'])
     ->name('fans.toggleStatus');
// فورم إنشاء فان جديد
Route::get('/fans/create', [FanController::class, 'create'])->name('fans.create');

// حفظ فان جديد
Route::post('/fans', [FanController::class, 'store'])->name('fans.store');
Route::get('/fans/bulk-pdf', [FanController::class, 'bulkPdf'])->name('fans.bulkPdf');
// عرض فان واحد بالتفصيل
Route::get('/fans/{fan}', [FanController::class, 'show'])->name('fans.show');
Route::get('/fans/{fan}/card', [FanController::class, 'cardPdf'])->name('fans.cardPdf');

// فورم تعديل فان
Route::get('/fans/{fan}/edit', [FanController::class, 'edit'])->name('fans.edit');
Route::get('/fansfans/inactive', [FanController::class, 'inactive'])
    ->name('fansfans.inactive');
// تحديث بيانات فان
Route::put('/fans/{fan}', [FanController::class, 'update'])->name('fans.update');
route::get('expired', [FanController::class, 'expired'])->name('fans.expired');
route::get('supprime/abonments', [AbonmentsController::class, 'supprime'])->name('abonments.supprime');
route::get('expired/abonments', [AbonmentsController::class, 'expired'])->name('abonments.expired');
// حذف فان
Route::delete('/fans/{fan}', [FanController::class, 'destroy'])->name('fans.destroy');
Route::post('/fans/{id}/renouveler', [FanController::class, 'renouvelerAbonment'])->name('fans.renouveler');
Route::patch('/abonments/{id}/toggle', [AbonmentsController::class, 'toggle'])->name('abonments.toggle');
Route::resource('appareils', AppareilController::class);
Route::post('/events/{id}/terminer', [EventController::class, 'terminer'])->name('events.terminer');
Route::get('events/{id}/statistics', [EventController::class, 'statistics'])
    ->name('events.statistics');

Route::delete('/abonments/{id}', [AbonmentsController::class, 'destroy'])->name('abonments.destroy');

Route::get('/payments/delete/{id}', [PaimntstController::class, 'deletePayment'])
    ->name('payments.delete');

Route::resource('events', EventController::class);
Route::resource('abonments', AbonmentsController::class);
Route::resource('Paimnts', PaimntstController::class);
Route::get('/paimnts/historique', [PaimntstController::class, 'historique'])->name('paimnts.historique');
Route::get('/paimnts/supprime', [PaimntstController::class, 'supprime'])->name('paimnts.supprime');
Route::get('/paimnts/{id}/historique', [PaimntstController::class, 'moveToHistorique'])
     ->name('paimnts.moveToHistorique');


Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
Route::get('dashboard',[dashboardController::class,'dashboard'])->name('dashboard');

});
//Route::get('/fanss', [FansController::class, 'index'])->name('fan.index');
//Route::get('/fanss/create', [FansController::class, 'create'])->name('fan.create');
///Route::post('/fanss', [FansController::class, 'store2'])->name('fan.store');
//Route::get('/fanss/{fan}', [FansController::class, 'show'])->name('fan.show');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
