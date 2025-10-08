<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\fan;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\AttendanceTicket;
use Illuminate\Support\Facades\DB;
class QrcodeScannerController extends Controller
{
    //
    public function verifyFan(Request $request)
    {
        $request->validate([
            'id_qrcode'  => 'required|string',
            'id_event'   => 'required|integer',
            'idappareil' => 'required|string'
        ]);

        $status  = 'checked_in';
        $message = '1';

        // 🔹 البحث عن الفان بالكود
        $fan = Fan::where('id_qrcode', $request->id_qrcode)
            ->with(['transactions.abonment'])
            ->first();

        // ===== 1. QR غير صالح =====
        if (!$fan) {
            $status  = 'qr_invalid';
            $message = '2';

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
       // if ($fan->status === 'inactive') {
       //     $status  = 'inactive_fan';
        //    $message = 'البطاقة غير نشطة ❌';

          //  Attendance::create([
            //    'fan_id'     => $fan->id,
           //     'id_event'   => $request->id_event,
            //    'idappareil' => $request->idappareil,
            //    'status'     => $status,
          //  ]);

           // return response()->json([
           //     'status'  => 'error',
           //     'message' => $message,
           // ], 403);
       // }

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
            $message = '3';

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
            ->whereIn('status', ['checked_in', 'absent'])
            ->count();
        $remaining = $totalMatches - $usedMatches;

        // ===== 5. تحقق من صلاحية البطاقة =====
        if ($remaining <= 0  || $fan->status === 'inactive') {
            $status  = 'expired';
            $message = '4';

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





 public function verifyTicket(Request $request)
{
    $validated = $request->validate([
        'id_qrcode'  => 'required|string',
        'id_event'   => 'required|integer',
        'idappareil' => 'required|string'
    ]);

    // 1️⃣ Find Ticket by QR
    $ticket = Ticket::where('id_qrcode', $validated['id_qrcode'])->first();

    if (!$ticket) {
        // Store failed attempt
        DB::table('attendance_tickets')->insert([
            'ticket_id'  => null,
            'id_event'   => $validated['id_event'],
            'idappareil' => $validated['idappareil'],
            'status'     => 'qr_invalid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status'  => 'error',
            //'message' => '2',
            'message' => 'رمز الاستجابة السريعة غير صالح',
        ], 404);
    }

    // 2️⃣ Ticket cancelled? (CHECK THIS FIRST!)
    if ($ticket->status === 'annuler') {
        DB::table('attendance_tickets')->insert([
            'ticket_id'  => $ticket->id,
            'id_event'   => $validated['id_event'],
            'idappareil' => $validated['idappareil'],
            'status'     => 'annuler_ticket',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status'  => 'error',
            //'message' => '3',
            'message' => 'التذكرة annuler',
        ], 403);
    }

    // 3️⃣ Check if Event is valid
    $event = Event::where('id', $validated['id_event'])
        ->where('status', 'active')
        ->first();

    if (!$event) {
        DB::table('attendance_tickets')->insert([
            'ticket_id'  => $ticket->id,
            'id_event'   => $validated['id_event'],
            'idappareil' => $validated['idappareil'],
            'status'     => 'invalid_event',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => 'الحدث غير صالح أو غير نشط',
        ], 404);
    }

    // 4️⃣ Already checked in?
    $alreadyChecked = DB::table('attendance_tickets')
        ->where('ticket_id', $ticket->id)
        ->where('id_event', $event->id)
        ->where('status', 'checked_in')
        ->exists();

    if ($alreadyChecked) {
        DB::table('attendance_tickets')->insert([
            'ticket_id'  => $ticket->id,
            'id_event'   => $event->id,
            'idappareil' => $validated['idappareil'],
            'status'     => 'scanned_twice',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status'  => 'error',
            //'message' => '4',
            'message' => 'تم مسح التذكرة ضوئياً مرتين',
        ], 409);
    }

    // 5️⃣ Success - Record attendance and update ticket
    DB::transaction(function () use ($ticket, $event, $validated) {
        DB::table('attendance_tickets')->insert([
            'ticket_id'  => $ticket->id,
            'id_event'   => $event->id,
            'idappareil' => $validated['idappareil'],
            'status'     => 'checked_in',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $ticket->update(['status' => 'active']);
    });

    return response()->json([
        'status'    => 'success',
        'message'   => '1',
        'ticket_id' => $ticket->id,
        'event_id'  => $event->id,
        'price'     => $ticket->price,
    ]);
}


}
