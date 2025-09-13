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

    $status  = 'checked_in';
    $message = 'الدخول مسموح ✅';
    $success = true;

    // 🔹 البحث عن الفان بالكود
    $fan = Fan::where('id_qrcode', $request->id_qrcode)
        ->with(['transactions.abonment'])
        ->first();

    if (!$fan) {
        $status  = 'qr_invalid';
        $message = 'QR code غير صالح';
        $success = false;

        Attendance::create([
            'fan_id'     => null,
            'id_event'   => $request->id_event,
            'idappareil' => $request->idappareil,
            'present'    => 0,
            'status'     => $status,
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => $message,
        ], 404);
    }

    // ✅ مجموع المباريات
    $totalMatches = $fan->transactions()->sum('nbrmatch');

    // ✅ عدد الحضور (المباريات المستهلكة)
    $usedMatches = Attendance::where('fan_id', $fan->id)
        ->where('present', 1)
        ->count();

    $remaining = $totalMatches - $usedMatches;

    if ($remaining <= 0) {
        $status  = 'expired';
        $message = 'البطاقة انتهت صلاحيتها (لا توجد مباريات متبقية)';
        $success = false;

        Attendance::create([
            'fan_id'     => $fan->id,
            'id_event'   => $request->id_event,
            'idappareil' => $request->idappareil,
            'present'    => 0,
            'status'     => $status,
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => $message,
        ], 403);
    }

    // ✅ تحقق من الحدث
    $event = Event::where('id', $request->id_event)
                  ->where('status', 'active')
                  ->first();
    if (!$event) {
        $status  = 'invalid_event';
        $message = 'الحدث غير صالح أو غير نشط';
        $success = false;

        Attendance::create([
            'fan_id'     => $fan->id,
            'id_event'   => $request->id_event,
            'idappareil' => $request->idappareil,
            'present'    => 0,
            'status'     => $status,
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => $message,
        ], 404);
    }

    // ✅ تحقق إذا حضر نفس الحدث من قبل
    $alreadyAttended = Attendance::where('fan_id', $fan->id)
        ->where('id_event', $event->id)
        ->where('present', 1)
        ->exists();

    if ($alreadyAttended) {
        $status  = 'scanned_twice';
        $message = 'الفان حضر هذا الحدث مسبقاً';
        $success = false;

        Attendance::create([
            'fan_id'     => $fan->id,
            'id_event'   => $event->id,
            'idappareil' => $request->idappareil,
            'present'    => 0,
            'status'     => $status,
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => $message,
        ], 409);
    }

    // ✅ تسجيل الحضور
    

    return response()->json([
        'status'            => 'success',
        'message'           => $message,
        'fan_id'            => $fan->id,
        'total_matches'     => $totalMatches,
        'used_matches'      => $usedMatches,
        'remaining_matches' => $remaining - 1,
    ]);
}





}
