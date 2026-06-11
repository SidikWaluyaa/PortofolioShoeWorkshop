<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'nama_reward',
        'jenis',
        'deskripsi',
        'kode_kupon',
        'nilai',
        'status_aktif',
        'minggu_ke',
        'berlaku_dari',
        'berlaku_sampai',
        'stok',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'status_aktif' => 'boolean',
            'minggu_ke' => 'integer',
            'stok' => 'integer',
            'berlaku_dari' => 'date',
            'berlaku_sampai' => 'date',
        ];
    }

    /**
     * Get the admin who created this reward.
     */
    public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get all claims for this reward.
     */
    public function userRewards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserReward::class);
    }

    /**
     * Check if the reward is currently valid and claimable.
     */
    public function isClaimable(): bool
    {
        if (!$this->status_aktif) return false;
        if ($this->stok !== null && $this->stok <= 0) return false;

        $today = now()->toDateString();
        if ($this->berlaku_dari && $today < $this->berlaku_dari->toDateString()) return false;
        if ($this->berlaku_sampai && $today > $this->berlaku_sampai->toDateString()) return false;

        return true;
    }
}
