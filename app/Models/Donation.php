<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'spk',
        'nama_sepatu',
        'brand',
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

    /** Only shoes rated above this condition (percent) are accepted as donations. */
    public const MIN_KONDISI = 70;

    /**
     * Condition choices on the donation form, stored as a percentage. All of them are above MIN_KONDISI;
     * the form also shows a "below 70%" card that explains the shoe can't be accepted.
     */
    public const KONDISI_OPTIONS = [
        95 => ['label' => 'Seperti baru', 'desc' => 'Jarang dipakai. Sol, upper, dan jahitan utuh, tanpa noda berarti.'],
        85 => ['label' => 'Sangat layak', 'desc' => 'Bekas pakai wajar. Sol masih tebal, tidak ada sobek atau lem yang lepas.'],
        75 => ['label' => 'Layak pakai', 'desc' => 'Ada tanda pakai: sol mulai aus, lecet atau noda ringan, tanpa kerusakan besar.'],
    ];

    /** Donations the workshop has received, which earn the donor one donation-reward claim. */
    public const REWARD_ELIGIBLE_STATUSES = ['diterima', 'siap_rilis', 'masuk_katalog', 'disalurkan'];

    /**
     * Whether the donor has actually chosen how to send the shoe. The column defaults to 'ekspedisi'
     * as a placeholder, so an expedition without a receipt number means "not chosen yet".
     */
    public function hasChosenShipping(): bool
    {
        return $this->metode_pengiriman === 'antar_langsung' || filled($this->no_resi);
    }

    public function getKondisiLabelAttribute(): ?string
    {
        return self::KONDISI_OPTIONS[$this->kondisi]['label'] ?? null;
    }

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
