<?php

namespace App\Services;

use App\Helpers\ImageCompressionHelper;
use App\Models\Donation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class DonationService
{
    /**
     * Create a new donation submission from a user.
     */
    public function create(array $data, UploadedFile $foto): Donation
    {
        $fotoPath = ImageCompressionHelper::compressAndStore($foto, 'donations/sepatu');

        return Donation::create([
            'user_id' => Auth::id(),
            'nama_sepatu' => $data['nama_sepatu'],
            'ukuran' => $data['ukuran'],
            'kondisi' => $data['kondisi'],
            'harga' => $data['harga'] ?? 0,
            'deskripsi' => $data['deskripsi'] ?? null,
            'foto_path' => $fotoPath,
            'metode_pengiriman' => $data['metode_pengiriman'],
            'nama_ekspedisi' => $data['nama_ekspedisi'] ?? null,
            'no_resi' => $data['no_resi'] ?? null,
            'status' => 'pending',
        ]);
    }

    /**
     * Get paginated donations for a specific user.
     */
    public function getByUser(int $userId, int $perPage = 10)
    {
        return Donation::where('user_id', $userId)
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    /**
     * Get all donations for admin moderation.
     */
    public function getAllForAdmin(int $perPage = 15, ?string $statusFilter = null)
    {
        $query = Donation::with('user', 'verifier')->orderByDesc('created_at');

        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        return $query->paginate($perPage);
    }

    /**
     * Approve a donation (admin action). Requires uploading proof photo.
     */
    public function approve(Donation $donation, UploadedFile $fotoBukti, ?string $catatan = null): Donation
    {
        $fotoBuktiPath = ImageCompressionHelper::compressAndStore($fotoBukti, 'donations/bukti');

        $donation->update([
            'status' => 'diterima',
            'foto_bukti_path' => $fotoBuktiPath,
            'catatan_admin' => $catatan,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        return $donation;
    }

    /**
     * Reject a donation (admin action).
     */
    public function reject(Donation $donation, string $catatan): Donation
    {
        $donation->update([
            'status' => 'ditolak',
            'catatan_admin' => $catatan,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        return $donation;
    }

    /**
     * Mark a donation as distributed (admin action).
     */
    public function markDistributed(Donation $donation, ?string $catatan = null): Donation
    {
        $donation->update([
            'status' => 'disalurkan',
            'catatan_admin' => $catatan ?? $donation->catatan_admin,
        ]);

        return $donation;
    }

    /**
     * Update shipping receipt (resi) for a donation.
     */
    public function updateResi(Donation $donation, string $namaEkspedisi, string $noResi): Donation
    {
        if ($donation->status !== 'pending') {
            throw new \Exception('Resi hanya dapat diubah ketika status donasi masih pending.');
        }

        $donation->update([
            'nama_ekspedisi' => $namaEkspedisi,
            'no_resi' => $noResi,
        ]);

        return $donation;
    }
}
