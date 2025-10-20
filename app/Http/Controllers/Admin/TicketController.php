<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Ticket;
use App\Models\Event;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;
class TicketController extends Controller
{
    //

  public function create($id)
{
    $event = Event::findOrFail($id);

   $tickets = Ticket::with(['user', 'attendanceTickets' => function($q) use ($event) {
        $q->where('id_event', $event->id);
    }])
    ->where('id_event', $event->id)
    ->get();


    return view('backend.tickets.create', compact('event', 'tickets'));
}


public function print($id)
{
    $ticket = Ticket::with('event')->findOrFail($id);
    $event = $ticket->event;

    return view('backend.tickets.pdf', compact('ticket', 'event'));
}




public function toggleStatus($id)
{
    $ticket = Ticket::findOrFail($id);

    // Toggle the status
    $ticket->status = $ticket->status === 'active' ? 'annuler' : 'active';
    $ticket->save();

    // Define message based on new status
    $message = $ticket->status === 'active'
        ? 'Le ticket a été activé avec succès ✅'
        : 'Le ticket a été annulé avec succès ❌';

    return response()->json([
        'success' => true,
        'new_status' => $ticket->status,
        'message' => $message,
    ]);
}









    public function store(Request $request)
    {
        $validated = $request->validate([
            'count'    => 'required|integer|min:1|max:1000',
            'id_event' => 'required|exists:events,id',
            'price'    => 'required|numeric|min:0',
        ]);

        $count = (int) $validated['count'];
        $price = (float) $validated['price'];
        $event = Event::findOrFail($validated['id_event']);
        $tickets = [];

        DB::transaction(function () use ($count, $price, $event, &$tickets) {
            $lastTicketNumber = Ticket::where('id_event', $event->id)
                ->lockForUpdate()
                ->max('ticket_number') ?? 0;

            for ($i = 1; $i <= $count; $i++) {
                $ticketNumber = $lastTicketNumber + $i;
                $ticketCode = 'TICKET-' . strtoupper(Str::random(8));

                $qrSvg = QrCode::format('svg')
                    ->size(80)
                    ->errorCorrection('H')
                    ->generate($ticketCode);
                $qrSvgBase64 = 'data:image/svg+xml;base64,' . base64_encode($qrSvg);

                $ticket = Ticket::create([
                    'ticket_number' => $ticketNumber,
                    'count'    => 1,
                    'id_qrcode'=> $ticketCode,
                    'id_event' => $event->id,
                    'id_user'  => auth()->id(),
                    'price'    => $price,
                    'status'   =>'active',
                    'qr_svg'   => $qrSvgBase64,
                ]);

                $tickets[] = [
                    'id' => $ticket->id,
                    'number' => $ticketNumber,
                    'code' => $ticketCode,
                    'price' => $price,
                    'qr_svg' => $qrSvgBase64,
                    'created_at' => $ticket->created_at->format('d/m/Y H:i:s'),
                ];
            }
        });

        // Get event image
        $eventImage = null;
        if ($event->image_post && file_exists(public_path('uploads/event/' . $event->image_post))) {
            $eventImage = asset('uploads/event/' . $event->image_post);
        }

        // Show thermal ticket preview
        return view('backend.tickets.thermal-preview', compact('tickets', 'event', 'eventImage'));
    }







}


