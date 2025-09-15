<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //
    public function dashboard()
{
    // Events
    $eventsActive   = \App\Models\Event::where('status', 'active')->count();
    $eventsInactive = \App\Models\Event::where('status', 'inactive')->count();
    $eventsTerminer = \App\Models\Event::where('status', 'terminer')->count();

    // Fans
    $fansCount = \App\Models\Fan::count();

    // Prix (assuming you want sum of price column)
    $prixTotal = \App\Models\TransactionPaimnt::sum('prix'); // change 'amount' to your column name

    // Appareils
    $appareilsCount = \App\Models\Appareil::count();
     $lastActiveFans = \App\Models\Fan::where('status', 'active')
                        ->orderBy('created_at', 'desc')
                        ->take(12)
                        ->get();

    return view('dashboard', compact(
        'eventsActive',
        'eventsInactive',
        'lastActiveFans',
        'eventsTerminer',
        'fansCount',
        'prixTotal',
        'appareilsCount'
    ));
}

}
