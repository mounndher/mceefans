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
   
    $tickets = Ticket::with('user')->where('id_event', $event->id)->get();


    return view('backend.tickets.create', compact('event', 'tickets'));
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


public function store2(Request $request)
{
    try {
        $validated = $request->validate([
            'count'    => 'required|integer|min:1|max:1000',
            'id_event' => 'required|exists:events,id',
            'price'    => 'required|numeric|min:0',
        ]);

        $uploadsFolder = public_path('uploads/tickets');
        if (!file_exists($uploadsFolder)) mkdir($uploadsFolder, 0777, true);

        $event = Event::findOrFail($validated['id_event']);
        $tickets = [];

        for ($i = 1; $i <= $validated['count']; $i++) {
            $ticketCode = 'TICKET-' . strtoupper(Str::random(8));

            // ✅ Generate clean QR SVG (no base64)
            $qrSvg = QrCode::format('svg')
                ->size(150)
                ->errorCorrection('H')
                ->generate($ticketCode);

            // ✅ Save to DB directly
            $ticket = Ticket::create([
                'count'     => $validated['count'],
                'id_event'  => $validated['id_event'],
                'price'     => $validated['price'],
                'id_user'   => auth()->id(),
                'id_qrcode' => $ticketCode,
                'qr_svg'    => $qrSvg,
            ]);

            $tickets[] = $ticket;
        }

        // ✅ Generate the PDF
        $pdfFileName = 'tickets_batch_' . time() . '.pdf';
        $pdfPath = $uploadsFolder . '/' . $pdfFileName;

        $pdf = Pdf::loadView('backend.tickets.pdf', [
            'tickets' => $tickets,
            'event'   => $event,
        ])->setPaper('a6', 'portrait')
          ->setOption('isHtml5ParserEnabled', true)
          ->setOption('isRemoteEnabled', true);

        $pdf->save($pdfPath);

        return response()->json([
            'success'  => true,
            'message'  => 'Tickets générés avec succès.',
            'pdf_path' => '/uploads/tickets/' . $pdfFileName,
            'total'    => count($tickets),
        ]);

    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
            'line'    => $e->getLine(),
        ], 500);
    }
}



public function storetext(Request $request)
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
                'number' => $ticketNumber,
                'code' => $ticketCode,
                'price' => $price,
                'qr_svg_base64' => $qrSvgBase64,
                'created_at' => $ticket->created_at->format('d/m/Y H:i:s'),
            ];
        }
    });
    
    // Convert event image to base64 for PDF
    $eventImageBase64 = null;
    if ($event->image_post) {
        $imagePath = public_path('uploads/event/' . $event->image_post);
        
        // Check if file exists
        if (file_exists($imagePath)) {
            $imageData = base64_encode(file_get_contents($imagePath));
            $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
            
            // Determine correct MIME type
            $mimeTypes = [
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
                'webp' => 'image/webp'
            ];
            
            $mimeType = $mimeTypes[strtolower($imageExtension)] ?? 'image/jpeg';
            $eventImageBase64 = 'data:' . $mimeType . ';base64,' . $imageData;
        }
    }
    
    // Generate PDF
   $pdf = Pdf::loadView('backend.tickets.pdf', compact('tickets', 'event', 'eventImageBase64'))
    ->setPaper([0, 0, 226.77, 226.77], 'portrait'); // 80mm x 80mm
    
    $pdfPath = storage_path('app/public/tickets.pdf');
    $pdf->save($pdfPath);
    
    return view('backend.tickets.print', [
        'pdfUrl' => asset('storage/tickets.pdf'),
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
                    ->size(200)
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


    private function printTickets($tickets, $event)
    {
        // Configure your printer name (adjust this to match your Xprint 410 printer name)
        $printerName = "XPrint 410"; // Change this to your actual printer name in Windows
        
        try {
            $connector = new WindowsPrintConnector($printerName);
            $printer = new Printer($connector);
            
            foreach ($tickets as $ticket) {
                $this->printSingleTicket($printer, $ticket, $event);
                
                // Add spacing between tickets
                if (!end($tickets) || $ticket !== end($tickets)) {
                    $printer->feed(3);
                    $printer->cut();
                }
            }
            
            $printer->close();
        } catch (\Exception $e) {
            throw new \Exception("Printer error: " . $e->getMessage());
        }
    }

    private function printSingleTicket($printer, $ticket, $event)
    {
        // Header line
        $printer->setEmphasis(true);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("================================\n");
        $printer->setEmphasis(false);
        
        // Event name
        $printer->setEmphasis(true);
        $printer->setTextSize(2, 2);
        $printer->text($this->centerText($event->nom, 16) . "\n");
        $printer->setTextSize(1, 1);
        $printer->setEmphasis(false);
        
        $printer->text("================================\n");
        $printer->feed(1);
        
        // Ticket number
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("NUMERO DE TICKET\n");
        $printer->setEmphasis(true);
        $printer->setTextSize(2, 1);
        $printer->text("#" . str_pad($ticket['number'], 4, '0', STR_PAD_LEFT) . "\n");
        $printer->setTextSize(1, 1);
        $printer->setEmphasis(false);
        $printer->feed(1);
        
        // Price
        $printer->text("--------------------------------\n");
        $printer->text("PRIX DU BILLET\n");
        $printer->setEmphasis(true);
        $printer->setTextSize(2, 2);
        $printer->text(number_format($ticket['price'], 2) . " DZD\n");
        $printer->setTextSize(1, 1);
        $printer->setEmphasis(false);
        $printer->text("--------------------------------\n");
        $printer->feed(1);
        
        // QR Code
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $this->printQRCode($printer, $ticket['code']);
        $printer->feed(1);
        $printer->text("Scannez pour valider\n");
        $printer->feed(1);
        
        // Footer
        $printer->text("--------------------------------\n");
        $printer->setTextSize(1, 1);
        $printer->text("Cree le: " . $ticket['created_at'] . "\n");
        $printer->text("Valable une fois\n");
        $printer->text("================================\n");
        $printer->feed(2);
    }

    private function printQRCode($printer, $ticketCode)
    {
        try {
            // Generate QR code as PNG
            $qrImage = QrCode::format('png')
                ->size(200)
                ->errorCorrection('H')
                ->generate($ticketCode);
            
            // Save temporarily
            $tempPath = storage_path('app/temp_qr.png');
            file_put_contents($tempPath, $qrImage);
            
            // Print image
            $image = EscposImage::load($tempPath);
            $printer->bitImage($image);
            
            // Clean up
            @unlink($tempPath);
        } catch (\Exception $e) {
            // Fallback: print ticket code as text
            $printer->text($ticketCode . "\n");
        }
    }

    private function centerText($text, $width)
    {
        $textLength = mb_strlen($text);
        if ($textLength >= $width) {
            return mb_substr($text, 0, $width);
        }
        $padding = floor(($width - $textLength) / 2);
        return str_repeat(' ', $padding) . $text;
    }


}


