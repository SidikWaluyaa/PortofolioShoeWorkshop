<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationItem extends Model
{
    use HasFactory;

    protected $appends = [
        'foto_utama_url',
        'foto_detail_urls',
        'jasa_nama',
        'jasa_harga_formatted',
        'jasa_estimasi_waktu_formatted',
        'berat_formatted',
        'score_kelayakan_color',
        'is_quota_full',
        'pending_requests_count',
    ];

    protected $fillable = [
        'donation_id',
        'kode_barang',
        'nama',
        'brand',
        'kategori',
        'status',
        'deskripsi',
        'foto_utama_path',
        'foto_detail',
        'kondisi',
        'ukuran',
        'berat',
        'score_kelayakan',
    ];

    protected static function booted()
    {
        static::created(function ($item) {
            if (empty($item->kode_barang)) {
                $suffix = [
                    'sepatu' => 'DS',
                    'tas' => 'DT',
                    'topi' => 'DP',
                ][$item->kategori] ?? 'DS';
                
                $item->kode_barang = str_pad($item->id, 3, '0', STR_PAD_LEFT) . '-' . $suffix;
                $item->saveQuietly();
            }
        });
    }

    /**
     * Get the original donation that generated this catalog item.
     */
    public function donation(): BelongsTo
    {
        return $this->belongsTo(Donation::class);
    }

    /**
     * Get the multiple services applied to this donation item.
     */
    public function reparationServices(): HasMany
    {
        return $this->hasMany(DonationItemService::class, 'donation_item_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'foto_detail' => 'array',
        ];
    }

    /**
     * Get the URL for the main photo.
     */
    public function getFotoUtamaUrlAttribute(): string
    {
        if (empty($this->foto_utama_path)) {
            return asset('images/placeholder.jpg');
        }
        if (str_starts_with($this->foto_utama_path, 'images/') || str_starts_with($this->foto_utama_path, 'storage/')) {
            return asset($this->foto_utama_path);
        }
        return asset('storage/' . $this->foto_utama_path);
    }

    /**
     * Get the URLs for the detailed photos.
     */
    public function getFotoDetailUrlsAttribute(): array
    {
        if (empty($this->foto_detail) || !is_array($this->foto_detail)) {
            return [];
        }
        return array_map(function ($path) {
            if (str_starts_with($path, 'images/') || str_starts_with($path, 'storage/')) {
                return asset($path);
            }
            return asset('storage/' . $path);
        }, $this->foto_detail);
    }

    /**
     * Get the combined service names.
     */
    public function getJasaNamaAttribute(): ?string
    {
        $names = $this->reparationServices->map(function ($rs) {
            return $rs->jasa_nama;
        })->filter()->all();

        return !empty($names) ? implode(', ', $names) : null;
    }

    /**
     * Get the total price of all services applied to this item.
     */
    public function getJasaHargaTotalAttribute(): int
    {
        return $this->reparationServices->sum('jasa_harga');
    }

    /**
     * Get the formatted total price of the services.
     */
    public function getJasaHargaFormattedAttribute(): string
    {
        $total = $this->jasa_harga_total;
        if ($total === 0) {
            return 'Gratis / N/A';
        }
        return 'Rp ' . number_format($total, 0, ',', '.');
    }

    /**
     * Get the formatted maximum estimation time.
     */
    public function getJasaEstimasiWaktuFormattedAttribute(): string
    {
        $max = $this->reparationServices->max('jasa_estimasi_waktu');
        if (is_null($max) || $max === 0) {
            return 'N/A';
        }
        return $max . ' Hari';
    }

    /**
     * Get the formatted weight.
     */
    public function getBeratFormattedAttribute(): string
    {
        if (is_null($this->berat)) {
            return '-';
        }
        if ($this->berat >= 1000) {
            return number_format($this->berat / 1000, 1, ',', '.') . ' kg';
        }
        return $this->berat . ' g';
    }

    /**
     * Get the CSS color class based on the feasibility score.
     */
    public function getScoreKelayakanColorAttribute(): string
    {
        $score = $this->score_kelayakan ?? 0;
        if ($score >= 90) {
            return 'emerald'; // Excellent
        }
        if ($score >= 70) {
            return 'teal'; // Very Good
        }
        if ($score >= 50) {
            return 'amber'; // Good
        }
        return 'red'; // Needs Attention
    }

    /**
     * Get the requests made for this donation item.
     */
    public function requests(): HasMany
    {
        return $this->hasMany(DonationRequest::class);
    }

    /**
     * Check if the quota for requesting this item is full (maximum 5 pending requests).
     */
    public function isQuotaFull(): bool
    {
        return $this->requests()->where('status', 'pending')->count() >= 5;
    }

    /**
     * Get whether the quota is full (attribute).
     */
    public function getIsQuotaFullAttribute(): bool
    {
        return $this->isQuotaFull();
    }

    /**
     * Get the number of pending requests for this item (attribute).
     */
    public function getPendingRequestsCountAttribute(): int
    {
        return $this->requests()->where('status', 'pending')->count();
    }
}
