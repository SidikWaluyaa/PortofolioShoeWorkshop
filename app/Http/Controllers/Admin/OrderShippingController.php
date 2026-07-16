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
    public function rollback(Request $request, DonationRequest $order)
    {
        // Pastikan hanya super_admin yang bisa mengakses
        if (auth()->user()->role !== 'super_admin') {
            return redirect()->back()->with('error', 'Akses ditolak! Hanya Super Admin yang dapat melakukan Rollback.');
        }

        // Cek apakah order ini valid untuk di rollback
        if (!in_array($order->status, ['diproses', 'dikirim', 'selesai'])) {
            return redirect()->back()->with('error', 'Pesanan ini tidak bisa di-rollback.');
        }

        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($order) {
                // Update status DonationRequest (Pesanan) menjadi dibatalkan
                $order->update(['status' => 'dibatalkan']);
                
                // Update status DonationItem (Sepatu) menjadi tersedia
                if ($order->donationItem) {
                    $order->donationItem->update(['status' => 'tersedia']);
                }
            });

            return redirect()->back()->with('success', 'Rollback berhasil! Pesanan dibatalkan dan Sepatu kembali tersedia di Katalog.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Rollback failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem saat melakukan Rollback.');
        }
    }
}
