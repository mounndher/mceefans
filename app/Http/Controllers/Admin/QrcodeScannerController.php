<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\fan;
use App\Models\Event;
class QrcodeScannerController extends Controller
{
    //
   public function verifyFan(Request $request)
{
    $request->validate([
        'id_qrcode'  => 'required|string',
        'id_event'   => 'required|integer',
        'idappareil' => 'required|integer'
    ]);

    // 🔹 البحث عن الفان بالكود
    $fan = Fan::where('id_qrcode', $request->id_qrcode)
        ->with(['transactions.abonment'])
        ->first();

    if (!$fan) {
        return response()->json([
            'status'  => 'error',
            'message' => 'QR Code غير صالح'
        ], 404);
    }

    // 🔹 آخر عملية شراء (أحدث اشتراك)
    $latestTransaction = $fan->transactions()->latest()->first();

    if (!$latestTransaction || !$latestTransaction->abonment) {
        return response()->json([
            'status'  => 'error',
            'message' => 'لا يوجد اشتراك صالح'
        ], 403);
    }

    $offer = $latestTransaction->abonment;

    // 🔹 عدد المباريات المستهلكة
    $usedMatches = Attendance::where('id_qrcode', $request->id_qrcode)
        ->where('present', 1)
        ->count();

    // 🔹 عدد المباريات المتبقية
    $remaining = $latestTransaction->nbrmatch - $usedMatches;

    if ($remaining <= 0) {
        return response()->json([
            'status'  => 'error',
            'message' => 'البطاقة انتهت صلاحيتها (لا توجد مباريات متبقية)'
        ], 403);
    }

    // 🔹 التحقق من الحدث الحالي
    $event = Event::where('id', $request->id_event)
                  ->where('status', 'active')
                  ->first();

    if (!$event) {
        return response()->json([
            'status'  => 'error',
            'message' => 'الحدث غير صالح أو غير نشط'
        ], 404);
    }

    // 🔹 تحقق إذا حضر نفس الحدث من قبل
    $alreadyAttended = Attendance::where('id_qrcode', $request->id_qrcode)
        ->where('id_event', $event->id)
        ->where('present', 1)
        ->exists();

    if ($alreadyAttended) {
        return response()->json([
            'status'  => 'error',
            'message' => 'الفان حضر هذا الحدث مسبقاً'
        ], 409);
    }

    // 🔹 تسجيل الحضور
    Attendance::create([
        'id_qrcode' => $request->id_qrcode,
        'id_event'  => $event->id,
        'idappareil'=> $request->idappareil,
        'present'   => 1,
        'status'    => 'checked_in',
        'created_at'=> now(),
        'updated_at'=> now(),
    ]);

    return response()->json([
        'status'             => 'success',
        'message'            => 'الدخول مسموح ✅',
        'remaining_matches'  => $remaining - 1 // بعد تسجيل الحضور
    ]);
}



}
