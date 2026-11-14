<?php

namespace App\Http\Controllers;

use App\Models\DonationItem;
use App\Models\Setting;

/**
 * Program page of Adapt & Adopt by ShoeWorkshop: what the program is, how donating and adopting work,
 * and a preview of shoes waiting for a new owner.
 */
class AdaptAdoptController extends Controller
{
    public function index()
    {
        $available = DonationItem::where('status', 'tersedia')
            ->withSum('reparationServices as total_reparation_price', 'jasa_harga');

        return view('adapt-adopt.index', [
            'items' => (clone $available)->latest()->take(4)->get(),
            'availableCount' => (clone $available)->count(),
            'adoptedCount' => DonationItem::where('status', 'disalurkan')->count(),
            'settings' => Setting::pluck('value', 'key')->all(),
        ]);
    }
}
