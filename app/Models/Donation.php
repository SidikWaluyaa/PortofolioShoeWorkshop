<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'spk',
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
        'is_reward_claimed',
    ];

    protected static function booted()
    {
        static::creating(function ($donation) {
            if (empty($donation->spk)) {
                $donation->spk = self::generateSpkNumber();
            }
        });
    }

    public static function generateSpkNumber()
    {
        $dateStr = now()->format('Ymd');
        do {
            $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $spk = "SPK-DN-{$dateStr}-{$random}";
        } while (self::where('spk', $spk)->exists());

        return $spk;
    }

    protected function casts(): array
    {
        return [
            'kondisi' => 'integer',
            'harga' => 'integer',
            'verified_at' => 'datetime',
            'is_reward_claimed' => 'boolean',
        ];
    }

    public function setFotoPathAttribute(mixed $value)
    {
        if (is_array($value)) {
            $this->attributes['foto_path'] = json_encode($value);
        } else {
            $this->attributes['foto_path'] = $value;
        }
    }

    public function getFotoPathAttribute(mixed $value)
    {
        if (empty($value)) {
            return [];
        }
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }
        return [$value];
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

    /**
     * Get the donation item generated in the catalog from this donation.
     */
    public function donationItem(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(DonationItem::class);
    }
}
