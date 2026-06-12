<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationItem extends Model
{
    use HasFactory;

    protected $appends = [
        'foto_utama_url',
        'foto_detail_urls',
    ];

    protected $fillable = [
        'donation_id',
        'nama',
        'brand',
        'kategori',
        'status',
        'deskripsi',
        'foto_utama_path',
        'foto_detail',
        'kondisi',
        'ukuran',
    ];

    /**
     * Get the original donation that generated this catalog item.
     */
    public function donation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Donation::class);
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
     * Get the requests made for this donation item.
     */
    public function requests(): HasMany
    {
        return $this->hasMany(DonationRequest::class);
    }
}
