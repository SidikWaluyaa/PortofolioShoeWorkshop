<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\DonationRequest;
use App\Models\HeroSection;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\TrustItem;
use App\Models\User;
use App\Models\Workflow;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        // ── Actionable KPIs ──────────────────────────────────────────
        $stats = [
            'donations_pending'         => Donation::where('status', 'pending')->count(),
            'donation_requests_pending' => DonationRequest::where('status', 'pending')->count(),
            'catalog_available'         => DonationItem::where('status', 'tersedia')->count(),
            'total_donators'            => User::where('role', '!=', 'admin')->count(),

            'projects'                  => Project::count(),
            'services'                  => Service::count(),
            'trust_items'               => TrustItem::count(),
            'workflows'                 => Workflow::count(),
            'posts'                     => Post::count(),
            'hero_active'               => HeroSection::where('is_active', true)->exists(),
        ];

        // ── Donasi Menunggu Verifikasi (max 5) ───────────────────────
        $pendingDonations = Donation::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // ── Permintaan Katalog Terbaru (max 5) ───────────────────────
        $pendingRequests = DonationRequest::with(['donationItem'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // ── Grafik Aktivitas 7 Hari Terakhir ─────────────────────────
        $chartLabels = [];
        $chartDonations = [];
        $chartRequests = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartLabels[]    = $date->translatedFormat('d M');
            $chartDonations[] = Donation::whereDate('created_at', $date)->count();
            $chartRequests[]  = DonationRequest::whereDate('created_at', $date)->count();
        }

        $chartData = [
            'labels'    => $chartLabels,
            'donations' => $chartDonations,
            'requests'  => $chartRequests,
        ];

        // ── Feed Aktivitas Terbaru ───────────────────────────────────
        $recentDonations = Donation::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($d) {
                return (object) [
                    'type'       => 'donation',
                    'icon'       => '📦',
                    'message'    => ($d->user->name ?? 'Seseorang') . ' mendonasikan "' . $d->nama_sepatu . '"',
                    'time'       => $d->created_at,
                    'time_human' => $d->created_at->diffForHumans(),
                ];
            });

        $recentRequests = DonationRequest::with('donationItem')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($r) {
                return (object) [
                    'type'       => 'request',
                    'icon'       => '🙋',
                    'message'    => $r->nama_pemohon . ' mengajukan permintaan untuk "' . ($r->donationItem->nama ?? '-') . '"',
                    'time'       => $r->created_at,
                    'time_human' => $r->created_at->diffForHumans(),
                ];
            });

        $activityFeed = $recentDonations->merge($recentRequests)
            ->sortByDesc('time')
            ->take(8)
            ->values();

        return view('dashboard', compact(
            'settings',
            'stats',
            'pendingDonations',
            'pendingRequests',
            'chartData',
            'activityFeed'
        ));
    }
}
