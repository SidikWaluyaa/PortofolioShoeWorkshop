<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonationRequest;

class OrderShippingController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'siap_kirim');

        $query = DonationRequest::with(['donationItem.donation', 'user'])
            ->whereNotNull('donation_item_id'); // Just to be safe, should have related item

        if ($tab === 'siap_kirim') {
            $query->where('status', 'diproses');
        } elseif ($tab === 'dikirim') {
            $query->where('status', 'dikirim');
        } elseif ($tab === 'selesai') {
            $query->where('status', 'selesai');
        } else {
            $query->whereIn('status', ['diproses', 'dikirim', 'selesai']);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders', 'tab'));
    }
}
