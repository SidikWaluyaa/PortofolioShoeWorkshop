<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'position',
        'type',
        'image_path',
        'image_url',
        'promo_text',
        'cta_text',
        'target_url',
        'is_active',
        'start_date',
        'end_date',
        'views_count',
        'clicks_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'views_count' => 'integer',
        'clicks_count' => 'integer',
    ];

    /**
     * Scope to filter active campaigns within validation period.
     */
    public function scopeActive($query)
    {
        $now = now();
        return $query->where((string) 'is_active', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', $now);
            });
    }

    /**
     * Accessor to get clean banner image URL.
     */
    public function getBannerUrlAttribute(): ?string
    {
        if ($this->type === 'image_upload') {
            return $this->image_path ? asset('storage/' . $this->image_path) : null;
        }
        return $this->image_url;
    }
}
