<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\QrcodeScannerController;
use App\Http\Controllers\Admin\AppareilController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::get('getallevent',[EventController::class, 'getAllEvent'])->name('getAllEvent');
route::post('scannerqr',[QrcodeScannerController::class, 'verifyFan'])->name('scannerqr');
route::get('getallappareils',[AppareilController::class, 'getAllAppareils'])->name('getAllAppareils');
