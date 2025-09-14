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

    // 🔹 البحث عن الفان بالكود
    $fan = Fan::where('id_qrcode', $request->id_qrcode)
        ->with(['transactions.abonment'])
        ->first();

    // ===== 1. QR غير صالح =====
    if (!$fan) {
        $status  = 'qr_invalid';
        $message = 'QR code غير صالح';

        Attendance::create([
            'fan_id'     => null,
            'id_event'   => $request->id_event,
            'idappareil' => $request->idappareil,
            'status'     => $status,
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => $message,
        ], 404);
    }

    // ===== 2. تحقق من الحدث =====
    $event = Event::where('id', $request->id_event)
                  ->where('status', 'active')
                  ->first();
    if (!$event) {
        $status  = 'invalid_event';
        $message = 'الحدث غير صالح أو غير نشط';

        Attendance::create([
            'fan_id'     => $fan->id,
            'id_event'   => $request->id_event,
            'idappareil' => $request->idappareil,
            'status'     => $status,
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => $message,
        ], 404);
    }

    // ===== 3. تحقق إذا حضر نفس الحدث مسبقاً =====
    $alreadyAttended = Attendance::where('fan_id', $fan->id)
        ->where('id_event', $event->id)
        ->where('status', 'checked_in')
        ->exists();

    if ($alreadyAttended) {
        $status  = 'scanned_twice';
        $message = 'الفان حضر هذا الحدث مسبقاً';

        Attendance::create([
            'fan_id'     => $fan->id,
            'id_event'   => $event->id,
            'idappareil' => $request->idappareil,
            'status'     => $status,
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => $message,
        ], 409);
    }

    // ===== 4. حساب المباريات =====
    $totalMatches = $fan->transactions()->sum('nbrmatch');
    $usedMatches = Attendance::where('fan_id', $fan->id)
        ->where('status', 'checked_in')
        ->count();
    $remaining = $totalMatches - $usedMatches;

    // ===== 5. تحقق من صلاحية البطاقة =====
    if ($remaining <= 0) {
        $status  = 'expired';
        $message = 'البطاقة انتهت صلاحيتها (لا توجد مباريات متبقية)';

        Attendance::create([
            'fan_id'     => $fan->id,
            'id_event'   => $request->id_event,
            'idappareil' => $request->idappareil,

            'status'     => $status,
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => $message,
        ], 403);
    }

    // ===== 6. تسجيل الحضور =====
    Attendance::create([
        'fan_id'     => $fan->id,
        'id_event'   => $event->id,
        'idappareil' => $request->idappareil,
        'status'     => $status,
    ]);

    return response()->json([
        'status'            => 'success',
        'message'           => $message,
        'fan_id'            => $fan->id,
        'total_matches'     => $totalMatches,
        'used_matches'      => $usedMatches + 1,
        'remaining_matches' => $remaining - 1,
    ]);
}




public function index(){

}




}
