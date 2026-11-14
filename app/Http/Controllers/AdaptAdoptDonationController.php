<?php

namespace App\Http\Controllers;

use App\Helpers\ImageCompressionHelper;
use App\Models\Donation;
use App\Models\DonationDraft;
use App\Services\DonationService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Public donation form of Adapt & Adopt. Anyone can fill it in; sending needs an account.
 * A guest's entry is kept as a DonationDraft, survives login/registration/email verification,
 * and is sent from the "Periksa lagi lalu kirim" page.
 */
class AdaptAdoptDonationController extends Controller
{
    public function __construct(protected DonationService $donationService) {}

    public function create(Request $request)
    {
        // Verified members already have the full form inside the member area
        if ($request->user()?->hasVerifiedEmail()) {
            return redirect()->route('member.donations.create');
        }

        return view('adapt-adopt.donasi.create', [
            'draft' => DonationDraft::fromSession($request->user()),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->user()?->hasVerifiedEmail()) {
            return redirect()->route('member.donations.create');
        }

        $validated = $request->validate([
            'nama_sepatu' => 'required|string|max:150',
            'brand' => 'nullable|string|max:100',
            'ukuran' => 'required|string|max:10',
            'kondisi' => ['required', 'integer', Rule::in(array_keys(Donation::KONDISI_OPTIONS))],
            'deskripsi' => 'nullable|string|max:2000',
            'foto' => 'required|array|max:4',
            'foto.*' => 'image|max:15360',
        ], [
            'kondisi.required' => 'Pilih kondisi sepatu.',
            'kondisi.in' => 'Kami hanya menerima sepatu dengan kelayakan di atas ' . Donation::MIN_KONDISI . '%. Pilih salah satu kondisi yang tersedia.',
            'foto.required' => 'Unggah minimal 1 foto sepatu.',
            'foto.max' => 'Maksimal 4 foto.',
            'foto.*.image' => 'File foto harus berupa gambar.',
            'foto.*.max' => 'Ukuran tiap foto maksimal 15 MB.',
        ]);

        DonationDraft::pruneStale();
        DonationDraft::fromSession($request->user())?->discard();

        $paths = [];
        foreach ($request->file('foto') as $file) {
            $paths[] = ImageCompressionHelper::compressAndStore($file, 'donations/sepatu');
        }

        $draft = DonationDraft::create([
            'user_id' => $request->user()?->id,
            'data' => collect($validated)->except('foto')->all(),
            'foto_path' => $paths,
        ]);
        $request->session()->put(DonationDraft::SESSION_KEY, $draft->id);

        // Signed in but not verified yet: the verification link brings them to the review page
        if ($request->user()) {
            return redirect()->route('verification.notice');
        }

        // After login or registration Laravel sends the donor straight to the review page
        $request->session()->put('url.intended', route('adapt-adopt.donasi.review'));

        return redirect()->route('adapt-adopt.donasi.pending');
    }

    /** "Satu langkah lagi": the draft is saved, now sign in or register. */
    public function pending(Request $request)
    {
        if ($request->user()) {
            return $request->user()->hasVerifiedEmail()
                ? redirect()->route('adapt-adopt.donasi.review')
                : redirect()->route('verification.notice');
        }

        $draft = DonationDraft::fromSession();
        if (!$draft) {
            return redirect()->route('adapt-adopt.donasi.create');
        }

        $request->session()->put('url.intended', route('adapt-adopt.donasi.review'));

        return view('adapt-adopt.donasi.pending', compact('draft'));
    }

    /** "Periksa lagi lalu kirim" (signed in and verified). */
    public function review(Request $request)
    {
        $draft = DonationDraft::current($request->user());
        if (!$draft) {
            return redirect()->route('member.donations.index');
        }

        return view('adapt-adopt.donasi.review', compact('draft'));
    }

    public function submit(Request $request, DonationDraft $draft)
    {
        abort_unless($draft->user_id === $request->user()->id, 404);

        $donation = $this->donationService->createWithPhotos($request->user(), $draft->data, $draft->foto_path);
        $draft->delete(); // the photos now belong to the donation
        $request->session()->forget(DonationDraft::SESSION_KEY);

        $this->donationService->announceSubmitted($donation);

        return redirect()->route('member.donations.index')
            ->with('success', 'Donasi sepatu berhasil diajukan! Cek email kamu untuk langkah selanjutnya.');
    }

    /** Drop the draft and start over. Works for guests (session draft) and members (their own draft). */
    public function discard(Request $request, DonationDraft $draft)
    {
        $ownsDraft = $request->user()
            ? $draft->user_id === $request->user()->id || $draft->is(DonationDraft::fromSession($request->user()))
            : $draft->is(DonationDraft::fromSession());
        abort_unless($ownsDraft, 404);

        $draft->discard();
        $request->session()->forget(DonationDraft::SESSION_KEY);

        return redirect()->route('adapt-adopt.donasi.create');
    }
}
