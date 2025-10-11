<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\fan;
use App\Models\AttendanceTicket;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = Event::all();
        return view('backend.event.index', compact('events'));
    }
    public function getAllEvent()
    {
        $events = Event::where('status', 'active')->get();

        return response()->json([
            'success' => true,
            'data' => $events,
        ], 200); // ✅ 200 OK status
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nom' => 'required|string',
            'subtitle' => 'required|string',
            'image_post' => 'required', // Or 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' if uploading an image
            'date' => 'required|string',
            'stade' => 'required|string',
            'status' => 'required|string',
        ]);
        $data = $request->all();
        if ($request->hasFile('image_post')) {
            $file = $request->file('image_post');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/event'), $filename);
            $data['image_post'] = $filename;
        }

        Event::create($data);

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */

public function terminer($id)
{
    $event = Event::findOrFail($id);

    // 1. Change status to "terminated"
    $event->status = 'terminated';
    $event->save();

    // 2. Get only active fans whose latest transaction is paid
    $fans = Fan::where('status', 'active')
        ->whereHas('latestTransaction', function ($q) {
            $q->where('statusp', 'p');
        })
        ->with('latestTransaction')
        ->get();

    foreach ($fans as $fan) {
        $alreadyPresent = Attendance::where('fan_id', $fan->id)
            ->where('id_event', $event->id)
            ->where('status', 'checked_in')
            ->exists();

        if (!$alreadyPresent) {
            Attendance::create([
                'fan_id'     => $fan->id,
                'id_event'   => $event->id,
                'idappareil' => null,
                'status'     => 'absent',
            ]);
        }
    }

    return redirect()->route('events.index')
        ->with('success', 'Event terminated successfully! Absentees recorded.');
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $event = Event::findOrFail($id);
        return view('backend.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string',
            'subtitle' => 'required|string',
            'image_post' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // optional on update
            'date' => 'required|string',
            'stade' => 'required|string',
            'status' => 'required|string',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image_post')) {
            // Delete old image if exists
            if ($event->image_post && file_exists(public_path('uploads/event/' . $event->image_post))) {
                unlink(public_path('uploads/event/' . $event->image_post));
            }

            $file = $request->file('image_post');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/event'), $filename);
            $data['image_post'] = $filename;
        } else {
            // Keep old image if no new image uploaded
            $data['image_post'] = $event->image_post;
        }

        $event->update($data);

        return redirect()->route('events.index')->with('success', "Événement mis à jour avec succès ! ");
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        // تحقق إذا عنده Paiements مرتبطة

       $event = Event::findOrFail($id);

        // 1. Change status to "terminated"
        $event->status = 'supprimé';
        $event->save();

        // لو مافيش Paiements، نحذف الـ Event


        return redirect()->route('events.index')
            ->with('success', "L'événement a été supprimé avec succès");
    }


   public function statistics1($id)
{
    $event = Event::findOrFail($id);

    // 🔹 عدد كل الفانز (ممكن يكون active + paid لو تحبنعدلها)
    //$fan = fan::count();
    $fans = \App\Models\fan::where('status', 'active')
    ->whereHas('transactions', function($q) {
        $q->where('statusp', 'p');
    })
    ->get();


$fan = $fans->count();

    // 🔹 الإحصائيات الأساسية
    $stats = Attendance::where('id_event', $event->id)
        ->selectRaw("
            SUM(CASE WHEN status = 'checked_in' THEN 1 ELSE 0 END) as checked_in,
            SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent,
            SUM(CASE WHEN status = 'qr_invalid' THEN 1 ELSE 0 END) as qr_invalid,
            SUM(CASE WHEN status = 'scanned_twice' THEN 1 ELSE 0 END) as scanned_twice,
            SUM(CASE WHEN status = 'expired' THEN 1 ELSE 0 END) as expired
        ")
        ->first();

    // 🔹 قيم آمنة
    $checkedIn = $stats->checked_in ?? 0;
    $absent    = $stats->absent ?? ($fan - $checkedIn);

    // 🔹 النسب %
    $percentagePresent = $fan > 0 ? round(($checkedIn / $fan) * 100, 2) : 0;
    $percentageAbsent  = $fan > 0 ? round(($absent / $fan) * 100, 2) : 0;

    // 🔹 إحصائيات لكل جهاز
    $perAppareilStats = Attendance::where('id_event', $event->id)
        ->selectRaw("
            idappareil,
            SUM(CASE WHEN status = 'checked_in' THEN 1 ELSE 0 END) as checked_in,
            SUM(CASE WHEN status = 'qr_invalid' THEN 1 ELSE 0 END) as qr_invalid,
            SUM(CASE WHEN status = 'scanned_twice' THEN 1 ELSE 0 END) as scanned_twice,
            SUM(CASE WHEN status = 'expired' THEN 1 ELSE 0 END) as expired
        ")
        ->groupBy('idappareil')
        ->with('appareil') // لازم تكون عندك علاقة Attendance -> appareil
        ->get();

    // 🔹 الفانز اللي اتعمل لهم scan مرتين
    //$scannedTwiceFans = Attendance::where('id_event', $event->id)
       // ->where('status', 'scanned_twice')
       // ->with('fan') // لازم تكون عندك علاقة Attendance -> fan
       // ->get();
      // 🔹 الفانز اللي اتعمل لهم scan مرتين (أو كل الحضور لهذا الحدث فقط)
$allAttendances = Attendance::where('id_event', $event->id)
    ->with(['fan', 'event'])
    ->get();

     $totalTickets = Ticket::where('id_event', $event->id)->count();

    // 🔹 Attendance stats from attendance_tickets table
    $statss = AttendanceTicket::where('id_event', $event->id)
        ->selectRaw("
            SUM(CASE WHEN status = 'checked_in' THEN 1 ELSE 0 END) as checked_in,
            SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent,
            SUM(CASE WHEN status = 'qr_invalid' THEN 1 ELSE 0 END) as qr_invalid,
            SUM(CASE WHEN status = 'scanned_twice' THEN 1 ELSE 0 END) as scanned_twice,
            SUM(CASE WHEN status = 'expired' THEN 1 ELSE 0 END) as expired
        ")
        ->first();

    // 🔹 Fallback safe values
    $checkedIn = $stats->checked_in ?? 0;
    $absent = $stats->absent ?? ($totalTickets - $checkedIn);

    // 🔹 Percentages
    $percentagePresent = $totalTickets > 0 ? round(($checkedIn / $totalTickets) * 100, 2) : 0;
    $percentageAbsent = $totalTickets > 0 ? round(($absent / $totalTickets) * 100, 2) : 0;

    // 🔹 Stats per device
    $perAppareilStats = AttendanceTicket::where('id_event', $event->id)
        ->selectRaw("
            idappareil,
            SUM(CASE WHEN status = 'checked_in' THEN 1 ELSE 0 END) as checked_in,
            SUM(CASE WHEN status = 'qr_invalid' THEN 1 ELSE 0 END) as qr_invalid,
            SUM(CASE WHEN status = 'scanned_twice' THEN 1 ELSE 0 END) as scanned_twice,
            SUM(CASE WHEN status = 'expired' THEN 1 ELSE 0 END) as expired
        ")
        ->groupBy('idappareil')
        ->with('appareil')
        ->get();

    // 🔹 All attendance records for this event
    $allAttendances = AttendanceTicket::where('id_event', $event->id)
        ->with(['ticket.user', 'event'])
        ->get();


    return view('backend.event.statistics', compact(
        'event',
        'stats',
        'fan',
        'checkedIn',
        'absent',
        'percentagePresent',
        'percentageAbsent',
        'perAppareilStats',
       'allAttendances',
       'totalTickets',
        'checkedIn',
        'absent',
        'percentagePresent',
        'percentageAbsent',
        'perAppareilStats',
        'allAttendances',
        'statss'
    ));
}





public function statistics($id)
{
    $event = Event::findOrFail($id);

    // 🔹 Nombre total de fans (actifs et payés)
    $fans = \App\Models\fan::where('status', 'active')
        ->whereHas('transactions', function($q) {
            $q->where('statusp', 'p');
        })
        ->get();
    $fan = $fans->count();

    // ==========================================================
    // 🔹 Partie 1 : Statistiques basées sur la table Attendance
    // ==========================================================
    $stats = Attendance::where('id_event', $event->id)
        ->selectRaw("
            SUM(CASE WHEN status = 'checked_in' THEN 1 ELSE 0 END) as checked_in,
            SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent,
            SUM(CASE WHEN status = 'qr_invalid' THEN 1 ELSE 0 END) as qr_invalid,
            SUM(CASE WHEN status = 'scanned_twice' THEN 1 ELSE 0 END) as scanned_twice,
            SUM(CASE WHEN status = 'expired' THEN 1 ELSE 0 END) as expired
        ")
        ->first();

    $checkedIn = $stats->checked_in ?? 0;
    $absent    = $stats->absent ?? ($fan - $checkedIn);

    $percentagePresent = $fan > 0 ? round(($checkedIn / $fan) * 100, 2) : 0;
    $percentageAbsent  = $fan > 0 ? round(($absent / $fan) * 100, 2) : 0;

    $perAppareilStats = Attendance::where('id_event', $event->id)
        ->selectRaw("
            idappareil,
            SUM(CASE WHEN status = 'checked_in' THEN 1 ELSE 0 END) as checked_in,
            SUM(CASE WHEN status = 'qr_invalid' THEN 1 ELSE 0 END) as qr_invalid,
            SUM(CASE WHEN status = 'scanned_twice' THEN 1 ELSE 0 END) as scanned_twice,
            SUM(CASE WHEN status = 'expired' THEN 1 ELSE 0 END) as expired
        ")
        ->groupBy('idappareil')
        ->with('appareil')
        ->get();

    $allAttendances = Attendance::where('id_event', $event->id)
        ->with(['fan', 'event'])
        ->get();

    // ==========================================================
    // 🔹 Partie 2 : Statistiques basées sur la table Ticket
    // ==========================================================
    $totalTickets = Ticket::where('id_event', $event->id)->count();

    // 🔹 Statistiques basées sur attendance_tickets
    $statss = AttendanceTicket::where('id_event', $event->id)
        ->selectRaw("
            SUM(CASE WHEN status = 'checked_in' THEN 1 ELSE 0 END) as checked_in,
            SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent,
            SUM(CASE WHEN status = 'qr_invalid' THEN 1 ELSE 0 END) as qr_invalid,
            SUM(CASE WHEN status = 'scanned_twice' THEN 1 ELSE 0 END) as scanned_twice,
            SUM(CASE WHEN status = 'annuler_ticket' THEN 1 ELSE 0 END) as expired
        ")
        ->first();

    $checkedInTickets = $statss->checked_in ?? 0;
    $absentTickets = $statss->absent ?? ($totalTickets - $checkedInTickets);

    $percentagePresentTickets = $totalTickets > 0 ? round(($checkedInTickets / $totalTickets) * 100, 2) : 0;
    $percentageAbsentTickets = $totalTickets > 0 ? round(($absentTickets / $totalTickets) * 100, 2) : 0;

    $perAppareilStatsTickets = AttendanceTicket::where('id_event', $event->id)
        ->selectRaw("
            idappareil,
            SUM(CASE WHEN status = 'checked_in' THEN 1 ELSE 0 END) as checked_in,
            SUM(CASE WHEN status = 'qr_invalid' THEN 1 ELSE 0 END) as qr_invalid,
            SUM(CASE WHEN status = 'scanned_twice' THEN 1 ELSE 0 END) as scanned_twice,
            SUM(CASE WHEN status = 'annuler_ticket' THEN 1 ELSE 0 END) as expired
        ")
        ->groupBy('idappareil')
        ->with('appareil')
        ->get();

    $allAttendancesTickets = AttendanceTicket::where('id_event', $event->id)
        ->with(['ticket.user', 'event'])
        ->get();
        $totalActivePrice = Ticket::where('id_event', $id)
        ->where('status', 'active')
        ->sum('price');
    $totalActiveTickets = Ticket::where('id_event', $id)->where('status', 'active')->count();
    $totalAnnulledTickets = Ticket::where('id_event', $id)->where('status', 'annuler')->count();

    // ==========================================================
    // 🔹 Retour vers la vue
    // ==========================================================
    return view('backend.event.statistics', compact(
        'event',
        // fans
        'fan', 'stats', 'checkedIn', 'absent', 'percentagePresent', 'percentageAbsent', 'perAppareilStats', 'allAttendances',
        // tickets
        'totalTickets', 'statss', 'checkedInTickets', 'absentTickets',
        'percentagePresentTickets', 'percentageAbsentTickets',
        'perAppareilStatsTickets', 'allAttendancesTickets','totalActivePrice',
        'totalActiveTickets','totalAnnulledTickets'
    ));
}



}
