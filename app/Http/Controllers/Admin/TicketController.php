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
        return view('backend.tickets.index');
    }
    public function create(){
      $events=Event::where('status','active');
      return view('backend.tickets.create',compact('events'));
    }


   public function store(Request $request)
    {
        // ✅ 1. Validation
        $validated = $request->validate([
            'count'    => 'required|integer|min:1|max:100',
            'id_event' => 'required|exists:events,id',
        ]);

        // ✅ 2. Prepare folder
        $uploadsFolder = public_path('uploads/tickets');
        if (!file_exists($uploadsFolder)) {
            mkdir($uploadsFolder, 0777, true);
        }

        $event = Event::findOrFail($validated['id_event']);
        $templatePath = public_path($event->card_template ?? 'templates/default_ticket.png');
        if (!file_exists($templatePath)) {
            return response()->json(['error' => 'Template not found.'], 404);
        }

        $tickets = [];

        // ✅ 3. Loop to generate multiple tickets
        for ($i = 1; $i <= $validated['count']; $i++) {

            // --- Generate unique QR ---
            $randomId = 'TICKET-' . strtoupper(Str::random(8));

            $qrFileName = $randomId . '_qr.png';
            $qrPath = $uploadsFolder . '/' . $qrFileName;
            $pngData = QrCode::format('png')->size(150)->generate($randomId);
            file_put_contents($qrPath, $pngData);
            $qrImage = '/uploads/tickets/' . $qrFileName;

            // --- Load template ---
            $template = imagecreatefrompng($templatePath);
            $cardWidth = imagesx($template);
            $cardHeight = imagesy($template);

            // --- Insert QR ---
            $qr = imagecreatefrompng($qrPath);
            $qrWidth = imagesx($qr);
            $qrHeight = imagesy($qr);
            $qrX = $cardWidth - $qrWidth - 30;
            $qrY = 30;
            imagecopy($template, $qr, $qrX, $qrY, 0, 0, $qrWidth, $qrHeight);
            imagedestroy($qr);

            // --- Add text ---
            $white = imagecolorallocate($template, 255, 255, 255);
            $font = public_path('fonts/Montserrat-Regular.ttf');
            imagettftext($template, 14, 0, 50, 100, $white, $font, 'Ticket No: ' . $i);
            imagettftext($template, 14, 0, 50, 140, $white, $font, 'Event: ' . strtoupper($event->name));
            imagettftext($template, 14, 0, 50, 180, $white, $font, 'Code: ' . $randomId);

            // --- Save ticket image ---
            $ticketFileName = $randomId . '_ticket.png';
            $ticketPath = $uploadsFolder . '/' . $ticketFileName;
            imagepng($template, $ticketPath);
            imagedestroy($template);

            // --- Save in DB ---
            $ticket = Ticket::create([
                'count'      => $validated['count'],
                'id_event'   => $validated['id_event'],
                'id_qrcode'  => $randomId,
                'card_temp'  => $event->card_template ?? '/templates/default_ticket.png',
                'qr_image'   => $qrImage,
                'imgticket'  => '/uploads/tickets/' . $ticketFileName,
            ]);

            $tickets[] = $ticket;
        }

        // ✅ 4. Generate ONE PDF for all tickets
        $pdfFileName = 'tickets_batch_' . time() . '.pdf';
        $pdfPath = $uploadsFolder . '/' . $pdfFileName;

        $pdf = Pdf::loadView('pdf.tickets-multi', [
            'tickets' => $tickets,
            'event'   => $event,
        ]);

        $pdf->save($pdfPath);

        // ✅ 5. Done (no redirect)
        // You can remove this JSON if you want to stay silent
        return response()->json([
            'success'    => true,
            'message'    => 'Tickets générés avec succès.',
            'total'      => count($tickets),
            'pdf_path'   => '/uploads/tickets/' . $pdfFileName,
        ]);
    }
}


