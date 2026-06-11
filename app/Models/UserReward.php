<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReward extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'reward_id',
        'minggu_ke',
        'unique_code',
        'claimed_at',
    ];

    protected function casts(): array
    {
        return [
            'minggu_ke' => 'integer',
            'claimed_at' => 'datetime',
        ];
    }

    /**
     * Get the user who claimed this reward.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reward that was claimed.
     */
    public function reward(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Reward::class);
    }
}
