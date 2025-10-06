<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Ticket;
use App\Models\Event;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
class TicketController extends Controller
{
    //
    public function index(){
        $Ticket=Ticket::All();
        return view('backend.tickets.index',compact('Ticket'));
    }
    public function create()
{
    $events = Event::where('status', 'active')->get();
    return view('backend.tickets.create', compact('events'));
}


 public function store1(Request $request)
{
    try {
        $validated = $request->validate([
            'count'    => 'required|integer|min:1|max:100',
            'id_event' => 'required|exists:events,id',
        ]);

        $uploadsFolder = public_path('uploads/tickets');
        if (!file_exists($uploadsFolder)) {
            mkdir($uploadsFolder, 0777, true);
        }

        $event = Event::findOrFail($validated['id_event']);
        $templatePath = public_path($event->card_template ?? 'card_templates/generated-image.png');

        if (!file_exists($templatePath)) {
            return response()->json(['error' => 'Template not found.'], 404);
        }

        $tickets = [];

        for ($i = 1; $i <= $validated['count']; $i++) {
            $randomId = 'TICKET-' . strtoupper(Str::random(8));

            $qrFileName = $randomId . '_qr.png';
            $qrPath = $uploadsFolder . '/' . $qrFileName;
            $pngData = QrCode::format('png')->size(150)->generate($randomId);
            file_put_contents($qrPath, $pngData);
            $qrImage = '/uploads/tickets/' . $qrFileName;

            $template = imagecreatefrompng($templatePath);
            $cardWidth = imagesx($template);
            $cardHeight = imagesy($template);

            $qr = imagecreatefrompng($qrPath);
            $qrWidth = imagesx($qr);
            $qrHeight = imagesy($qr);
            $qrX = $cardWidth - $qrWidth - 30;
            $qrY = 30;
            imagecopy($template, $qr, $qrX, $qrY, 0, 0, $qrWidth, $qrHeight);
            imagedestroy($qr);

            $white = imagecolorallocate($template, 255, 255, 255);
            $font = public_path('fonts/Montserrat-Regular.ttf');
            imagettftext($template, 14, 0, 50, 100, $white, $font, 'Ticket No: ' . $i);
            imagettftext($template, 14, 0, 50, 140, $white, $font, 'Event: ' . strtoupper($event->nom));
            imagettftext($template, 14, 0, 50, 180, $white, $font, 'Code: ' . $randomId);

            $ticketFileName = $randomId . '_ticket.png';
            $ticketPath = $uploadsFolder . '/' . $ticketFileName;
            imagepng($template, $ticketPath);
            imagedestroy($template);

            $tickets[] = Ticket::create([
                'count'      => $validated['count'],
                'id_event'   => $validated['id_event'],
                'id_qrcode'  => $randomId,
                'card_temp'  => $event->card_template ?? '/templates/default_ticket.png',
                'qr_image'   => $qrImage,
                'imgticket'  => '/uploads/tickets/' . $ticketFileName,
            ]);
        }

        $pdfFileName = 'tickets_batch_' . time() . '.pdf';
        $pdfPath = $uploadsFolder . '/' . $pdfFileName;

        $pdf = Pdf::loadView('backend.tickets.pdf', [
            'tickets' => $tickets,
            'event'   => $event,
        ]);

        $pdf->save($pdfPath);

        return response()->json([
            'success'  => true,
            'message'  => 'Tickets générés avec succès.',
            'total'    => count($tickets),
            'pdf_path' => '/uploads/tickets/' . $pdfFileName,
        ]);

    } catch (\Throwable $e) {
        // ✅ Capture propre des erreurs PHP/Laravel
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'line'    => $e->getLine(),
        ], 500);
    }
}
public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'count'    => 'required|integer|min:1|max:100',
            'id_event' => 'required|exists:events,id',
        ]);

        $uploadsFolder = public_path('uploads/tickets');
        if (!file_exists($uploadsFolder)) {
            mkdir($uploadsFolder, 0777, true);
        }

        $event = Event::findOrFail($validated['id_event']);
        $tickets = [];

        for ($i = 1; $i <= $validated['count']; $i++) {
            $ticketCode = 'TICKET-' . strtoupper(Str::random(8));

            // Generate QR code image
            $qrFileName = $ticketCode . '_qr.png';
            $qrPath = $uploadsFolder . '/' . $qrFileName;
            QrCode::format('png')->size(200)->generate($ticketCode, $qrPath);

            // Insert ticket in DB
            $ticket = Ticket::create([
                'count'      => $validated['count'],
                'id_event'   => $validated['id_event'],
                'id_qrcode'  => $ticketCode,
                'qr_image'   => '/uploads/tickets/' . $qrFileName,
                'imgticket'  => '/uploads/tickets/' . $qrFileName, // same QR as ticket image
            ]);

            $tickets[] = $ticket;
        }

        // Generate PDF
        $pdfFileName = 'tickets_batch_' . time() . '.pdf';
        $pdfPath = $uploadsFolder . '/' . $pdfFileName;

        $pdf = Pdf::loadView('backend.tickets.pdf', [
            'tickets' => $tickets,
            'event'   => $event,
        ]);

        $pdf->save($pdfPath);

        return response()->json([
            'success'  => true,
            'message'  => 'Tickets générés avec succès.',
            'total'    => count($tickets),
            'pdf_path' => '/uploads/tickets/' . $pdfFileName,
        ]);

    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'line'    => $e->getLine(),
        ], 500);
    }
}

}


