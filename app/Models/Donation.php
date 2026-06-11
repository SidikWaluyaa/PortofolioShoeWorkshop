<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'nama_sepatu',
        'ukuran',
        'kondisi',
        'harga',
        'deskripsi',
        'foto_path',
        'foto_bukti_path',
        'metode_pengiriman',
        'nama_ekspedisi',
        'no_resi',
        'status',
        'catatan_admin',
        'verified_by',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'kondisi' => 'integer',
            'harga' => 'integer',
            'verified_at' => 'datetime',
        ];
    }

    /**
     * Get the user who made this donation.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who verified this donation.
     */
    public function verifier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
