<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
class AttendanceController extends Controller
{
    //
    public function index(Request $request)
{
    $query = Attendance::with(['fan', 'event', 'appareil']); // eager loading

    // لو كاين كلمة بحث
    if ($request->filled('search')) {
        $search = $request->input('search');

        $query->whereHas('fan', function ($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%");
        })->orWhereHas('event', function ($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%");
        })->orWhereHas('appareil', function ($q) use ($search) {
            $q->where('nom_utilisateur', 'like', "%{$search}%");
        })->orWhere('status', 'like', "%{$search}%");
    }

    $attendances = $query->paginate(15);

    return view('backend.attendance.index', compact('attendances'));
}




}
