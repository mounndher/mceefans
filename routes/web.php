<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FanController;
use App\Http\Controllers\Admin\AbonmentsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PaimntstController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\AppareilController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\WhatwedoController;
use App\Http\Controllers\Admin\FeaturesController;
use App\Http\Controllers\Admin\MatchHighlightsController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\Admin\MatchHighlightsTextController;
use App\Http\Controllers\Admin\SucessController;
use App\Http\Controllers\Admin\VotreCartController;
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
Route::post('/generate-card-preview', [IndexController::class, 'index'])->name('generate.card.preview');
Route::get('/fans/{fan}/cardtelecharger', [FanController::class, 'cardPdftelecharger'])
->name('fans.cardPdftelecharger');
Route::get('/generate-card-index', [IndexController::class, 'create'])->name('generate.card.index');






///////////// admin////////////////////
Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/create', function () {
    return view('backend.fans.create');
});
///user///////////////////////////////
Route::resource('users', UserController::class)->except(['show']);
///////////////////// fans///////////////////////////////////
Route::get('/fans', [FanController::class, 'index'])->name('fans.index');
//Route::post('mceefans/{id}/regenerate', [FanController::class, 'regenerate']);
// web.php
Route::post('fans/{id}/regenerate', [FanController::class, 'regenerate'])->name('fans.regenerate');
Route::post('/fans/toggle-status/{id}', [App\Http\Controllers\Admin\FanController::class, 'toggleStatus'])
     ->name('fans.toggleStatus');
Route::get('/fans/create', [FanController::class, 'create'])->name('fans.create');
Route::post('/fans', [FanController::class, 'store'])->name('fans.store');
Route::get('/fans/bulk-pdf', [FanController::class, 'bulkPdf'])->name('fans.bulkPdf');
Route::get('/fans/{fan}', [FanController::class, 'show'])->name('fans.show');
Route::get('/fans/{fan}/card', [FanController::class, 'cardPdf'])->name('fans.cardPdf');
Route::get('/fans/{fan}/edit', [FanController::class, 'edit'])->name('fans.edit');
Route::get('/fansfans/inactive', [FanController::class, 'inactive'])
    ->name('fansfans.inactive');
Route::put('/fans/{fan}', [FanController::class, 'update'])->name('fans.update');
route::get('expired', [FanController::class, 'expired'])->name('fans.expired');
Route::delete('/fans/{fan}', [FanController::class, 'destroy'])->name('fans.destroy');
Route::post('/fans/{id}/renouveler', [FanController::class, 'renouvelerAbonment'])->name('fans.renouveler');
/////////////////////Abonments///////////////////////////////
route::get('supprime/abonments', [AbonmentsController::class, 'supprime'])->name('abonments.supprime');
route::get('expired/abonments', [AbonmentsController::class, 'expired'])->name('abonments.expired');
Route::patch('/abonments/{id}/toggle', [AbonmentsController::class, 'toggle'])->name('abonments.toggle');
Route::delete('/abonments/{id}', [AbonmentsController::class, 'destroy'])->name('abonments.destroy');
Route::resource('abonments', AbonmentsController::class);
/////////////////////events///////////////////////////////
Route::post('/events/{id}/terminer', [EventController::class, 'terminer'])->name('events.terminer');
Route::get('events/{id}/statistics', [EventController::class, 'statistics'])
    ->name('events.statistics');
Route::resource('events', EventController::class);
/////////////////////appareils///////////////////////////////
 Route::resource('appareils', AppareilController::class);
/////////////////////Paimnts///////////////////////////////
Route::get('/payments/delete/{id}', [PaimntstController::class, 'deletePayment'])
    ->name('payments.delete');
Route::resource('Paimnts', PaimntstController::class);
Route::get('/paimnts/historique', [PaimntstController::class, 'historique'])->name('paimnts.historique');
Route::get('/paimnts/supprime', [PaimntstController::class, 'supprime'])->name('paimnts.supprime');
Route::get('/paimnts/{id}/historique', [PaimntstController::class, 'moveToHistorique'])
     ->name('paimnts.moveToHistorique');
/////////////////////Attendance///////////////////////////////
Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
/////////////////////dashboard///////////////////////////////
Route::get('dashboard',[dashboardController::class,'dashboard'])->name('dashboard');
////////heroo///////////////////////////////////
Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
Route::put('/hero/update/{id}', [HeroController::class, 'update'])->name('hero.update');
////////about///////////////////////////////////
Route::get('/admin/about', [AboutController::class, 'index'])->name('about.index');
Route::post('/admin/about/{id}', [AboutController::class, 'update'])->name('about.update');

/////contact///////////////////////////////
Route::get('/admin/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/admin/contact/update/{id}', [ContactController::class, 'update'])->name('contact.update');
Route::post('/contact/send', [ContactMessageController::class, 'store'])->name('contact.send');
Route::get('/contact/display', [ContactMessageController::class, 'index'])->name('contact.display');
//service///////////////////
Route::resource('services', ServicesController::class);
// Mettre à jour les paramètres
Route::post('/settings/{id}', [SettingController::class, 'update'])->name('settings.update');
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
/////mail settings///////////////////////////////
Route::get('mail-settings', [MailController::class, 'index'])
    ->name('mail-settings.index');
Route::put('mail-settings/{id}', [MailController::class, 'update'])
    ->name('mail-settings.update');
// what-we-do------------------------
Route::get('whatwedos', [WhatwedoController::class, 'index'])->name('whatwedos.index');
Route::put('whatwedos/{id}', [WhatwedoController::class, 'update'])->name('whatwedos.update');

Route::get('features', [FeaturesController::class, 'index'])->name('features.index');
// Update a specific feature
Route::put('features/{id}', [FeaturesController::class, 'update'])->name('features.update');
//match_highlights
Route::resource('match_highlights', MatchHighlightsController::class);
//highlights
Route::get('match-highlights-text', [MatchHighlightsTextController::class, 'index'])->name('match_highlights_text.index');
Route::post('match-highlights-text/update', [MatchHighlightsTextController::class, 'update'])->name('match_highlights_text.update');
//
Route::get('/success', [SucessController::class, 'index'])->name('success.index');
Route::post('/success/update/{id}', [SucessController::class, 'update'])->name('success.update');

Route::get('votrecart', [VotreCartController::class, 'index'])->name('votrecart.index');
Route::put('votrecart/{id}', [VotreCartController::class, 'update'])->name('votrecart.update');




Route::get('/fancardshow', [FanController::class, 'showcard'])->name('fan.cardshow');
Route::get('/fancardcreate', [FanController::class, 'createcard'])->name('fan.cardcreate');
Route::post('/fancardstore', [FanController::class, 'storecard'])->name('fan.cardstore');
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
 route::get('/sendsms',[SmsController::class,'sendsms']);
require __DIR__.'/auth.php';
