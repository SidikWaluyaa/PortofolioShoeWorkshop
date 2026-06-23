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
    public function create(array $data, mixed $foto): Donation
    {
        $fotoPaths = [];
        if (is_array($foto)) {
            foreach ($foto as $file) {
                $fotoPaths[] = ImageCompressionHelper::compressAndStore($file, 'donations/sepatu');
            }
        } else {
            $fotoPaths[] = ImageCompressionHelper::compressAndStore($foto, 'donations/sepatu');
        }

        return Donation::create([
            'user_id' => Auth::id(),
            'nama_sepatu' => $data['nama_sepatu'],
            'ukuran' => $data['ukuran'],
            'kondisi' => $data['kondisi'],
            'harga' => $data['harga'] ?? 0,
            'deskripsi' => $data['deskripsi'] ?? null,
            'foto_path' => $fotoPaths,
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
        return Donation::where((string) 'user_id', $userId)
            ->orderByDesc((string) 'created_at')
            ->paginate($perPage);
    }

    /**
     * Get all donations for admin moderation.
     */
    public function getAllForAdmin(int $perPage = 15, ?string $statusFilter = null)
    {
        $query = Donation::with('user', (string) 'verifier')->orderByDesc((string) 'created_at');

        if ($statusFilter) {
            $query->where((string) 'status', $statusFilter);
        }

        return $query->paginate($perPage);
    }

    /**
     * Approve a donation (admin action). Requires uploading proof photo and catalog inspection data.
     */
    public function approve(Donation $donation, UploadedFile $fotoBukti, array $inspectionData, ?string $catatan = null): Donation
    {
        $fotoBuktiPath = ImageCompressionHelper::compressAndStore($fotoBukti, 'donations/bukti');

        $donation->update([
            'status' => 'diterima',
            'foto_bukti_path' => $fotoBuktiPath,
            'catatan_admin' => $catatan,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        \App\Models\DonationItem::create([
            'donation_id' => $donation->id,
            'nama' => $inspectionData['nama'],
            'brand' => $inspectionData['brand'] ?? null,
            'kategori' => $inspectionData['kategori'],
            'kondisi' => $inspectionData['kondisi'],
            'status' => 'tersedia',
            'deskripsi' => $inspectionData['deskripsi'] ?? null,
            'foto_utama_path' => $donation->foto_path[0] ?? '',
            'foto_detail' => $donation->foto_path,
            'ukuran' => $inspectionData['ukuran'] ?? null,
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

    /**
     * Update a pending donation submission from a user.
     */
    public function update(Donation $donation, array $data, mixed $fotos = null, array $existingPhotos = []): Donation
    {
        if ($donation->status !== 'pending') {
            throw new \Exception('Donasi hanya dapat diubah ketika status masih pending.');
        }

        $updateData = [
            'nama_sepatu' => $data['nama_sepatu'],
            'ukuran' => $data['ukuran'],
            'kondisi' => $data['kondisi'],
            'harga' => $data['harga'] ?? 0,
            'deskripsi' => $data['deskripsi'] ?? null,
            'metode_pengiriman' => $data['metode_pengiriman'],
            'nama_ekspedisi' => $data['nama_ekspedisi'] ?? null,
            'no_resi' => $data['no_resi'] ?? null,
        ];

        // Compress and store new photos
        $newFotoPaths = [];
        if ($fotos) {
            if (is_array($fotos)) {
                foreach ($fotos as $file) {
                    $newFotoPaths[] = ImageCompressionHelper::compressAndStore($file, 'donations/sepatu');
                }
            } else {
                $newFotoPaths[] = ImageCompressionHelper::compressAndStore($fotos, 'donations/sepatu');
            }
        }

        // Combine valid remaining existing photos and new photos
        $currentPhotos = $donation->foto_path ?? [];
        $validExisting = array_values(array_intersect($existingPhotos, $currentPhotos));
        $finalFotoPaths = array_merge($validExisting, $newFotoPaths);

        if (count($finalFotoPaths) === 0) {
            throw new \Exception('Sepatu harus memiliki setidaknya satu foto.');
        }

        $updateData['foto_path'] = $finalFotoPaths;

        $donation->update($updateData);

        return $donation;
    }
}
