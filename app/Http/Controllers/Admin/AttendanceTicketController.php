<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttendanceTicket;
class AttendanceTicketController extends Controller
{
    //
    public function index (Request $request)
{
    $query = AttendanceTicket::with(['ticket', 'event', 'appareil']); // eager load ticket, event, appareil

    // 🔍 إذا وُجدت كلمة بحث
    if ($request->filled('search')) {
        $search = $request->input('search');

        $query->whereHas('ticket', function ($q) use ($search) {
            $q->where('id_qrcode', 'like', "%{$search}%")
              ->orWhere('id_user', 'like', "%{$search}%");
        })
        ->orWhereHas('event', function ($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%");
        })
        ->orWhereHas('appareil', function ($q) use ($search) {
            $q->where('nom_utilisateur', 'like', "%{$search}%");
        })
        ->orWhere('status', 'like', "%{$search}%");
    }

    $attendances = $query->paginate(15);

    return view('backend.attendance.indexticket', compact('attendances'));
}
}
