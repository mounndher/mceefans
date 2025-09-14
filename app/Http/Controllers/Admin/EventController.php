<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\fan;

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

        // 2. Get all fans (من transactions أو حسب نظامك)
        $fans = Fan::all(); // أو Fan::whereHas('transactions')...

        foreach ($fans as $fan) {
            $alreadyPresent = Attendance::where('fan_id', $fan->id)
                ->where('id_event', $event->id)
                ->where('status', 'checked_in')
                ->exists();

            // 3. If not present, mark as absent
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

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

    public function statistics($id)
    {
        $event = Event::findOrFail($id);

        // نحسب الإحصائيات
        $stats = Attendance::where('id_event', $event->id)
            ->selectRaw("
            SUM(CASE WHEN status = 'checked_in' THEN 1 ELSE 0 END) as checked_in,
            SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent,
            SUM(CASE WHEN status = 'qr_invalid' THEN 1 ELSE 0 END) as qr_invalid,
            SUM(CASE WHEN status = 'scanned_twice' THEN 1 ELSE 0 END) as scanned_twice,
            SUM(CASE WHEN status = 'expired' THEN 1 ELSE 0 END) as expired
        ")
            ->first();

        return view('backend.event.statistics', compact('event', 'stats'));
    }
}
