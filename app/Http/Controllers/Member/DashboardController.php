<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\DonationRequest;
use App\Services\CheckinService;
use App\Services\ReparationHistoryService;
use App\Support\MemberFeatures;
use Illuminate\Support\Facades\Auth;

/**
 * Member home: what needs the member's action across repairs, adoptions and donations,
 * plus one summary card per area.
 */
class DashboardController extends Controller
{
    public function __construct(
        protected CheckinService $checkinService,
        protected ReparationHistoryService $reparations,
    ) {}

    public function index()
    {
        $user = Auth::user();

        $adoptions = DonationRequest::with('donationItem')->where('user_id', $user->id)->latest()->get();
        $donations = $user->donations()->latest()->get();
        $reparation = $this->reparations->forUser($user);
        $reparationSummary = $reparation['status'] === 'success' ? $this->reparations->summary($reparation['orders']) : null;

        $tasks = collect();

        foreach ($adoptions as $request) {
            $name = $request->donationItem?->nama ?? 'sepatu adopsi';
            $url = route('member.adoption-requests.show', $request->id);

            if ($request->status === 'menunggu_pembayaran' && !$request->isOnHold() && !$request->otherOrderInProgress()) {
                $tasks->push([
                    'icon' => 'payments',
                    'tone' => $request->isPaymentOverdue() ? 'red' : 'amber',
                    'title' => "Bayar tagihan adopsi {$name}",
                    'desc' => match (true) {
                        $request->isPaymentOverdue() => 'Batas waktu pembayaran sudah lewat. Segera unggah bukti transfer atau hubungi CS.',
                        (bool) $request->batas_bayar => 'Selesaikan sebelum ' . $request->batas_bayar->translatedFormat('l, d M, H.i') . ' WIB.',
                        default => 'Transfer sesuai tagihan, lalu unggah bukti transfernya.',
                    },
                    'url' => $url . '#pembayaran',
                    'cta' => 'Bayar',
                ]);
            } elseif ($request->status === 'dikirim') {
                $tasks->push([
                    'icon' => 'local_shipping',
                    'tone' => 'emerald',
                    'title' => "Konfirmasi {$name} sudah diterima",
                    'desc' => 'Sudah sampai? Unggah foto paket supaya adopsi selesai.',
                    'url' => $url . '#konfirmasi',
                    'cta' => 'Konfirmasi',
                ]);
            }
        }

        foreach ($donations as $donation) {
            if ($donation->status === 'disetujui' && !$donation->hasChosenShipping()) {
                $tasks->push([
                    'icon' => 'volunteer_activism',
                    'tone' => 'amber',
                    'title' => "Kirim sepatu donasi {$donation->nama_sepatu}",
                    'desc' => 'Donasimu disetujui. Kirim ke workshop lalu isi cara pengirimannya.',
                    'url' => route('member.donations.index'),
                    'cta' => 'Isi pengiriman',
                ]);
            }
        }

        // Repair balances aren't shown: the workshop API's payment figures miss invoice payments
        foreach ($reparationSummary['ready'] ?? [] as $order) {
            $tasks->push([
                'icon' => 'storefront',
                'tone' => 'emerald',
                'title' => 'Sepatu ' . trim(($order['brand'] ?? '') . ' ' . ($order['type'] ?? '')) . ' siap diambil',
                'desc' => 'SPK ' . $order['spk'] . ' selesai dikerjakan. Ambil di workshop Senin–Sabtu, 09.00–17.00 WIB.',
                'url' => route('member.reparation-history.index'),
                'cta' => 'Lihat',
            ]);
        }

        if ($reparation['status'] === 'missing_phone') {
            $tasks->push([
                'icon' => 'phone_iphone',
                'tone' => 'blue',
                'title' => 'Lengkapi nomor HP',
                'desc' => 'Riwayat reparasimu muncul otomatis dari nomor HP yang terdaftar di workshop.',
                'url' => route('profile.edit'),
                'cta' => 'Lengkapi',
            ]);
        }

        $streakStatus = MemberFeatures::checkinEnabled() ? $this->checkinService->getStreakStatus($user->id) : null;

        return view('member.dashboard', [
            'user' => $user,
            'tasks' => $tasks,
            'latestAdoption' => $adoptions->first(),
            'latestDonation' => $donations->first(),
            'reparation' => $reparation,
            'reparationSummary' => $reparationSummary,
            'streakStatus' => $streakStatus,
        ]);
    }
}
