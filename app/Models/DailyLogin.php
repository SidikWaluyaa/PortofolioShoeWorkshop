<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyLogin extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tanggal_checkin',
        'foto_sepatu_path',
        'minggu_ke',
        'hari_ke',
        'status',
        'reward_claimed',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_checkin' => 'date',
            'minggu_ke' => 'integer',
            'hari_ke' => 'integer',
            'reward_claimed' => 'boolean',
            'created_at' => 'datetime',
        ];
    }

    /**
     * Get the user who made this check-in.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all check-ins in the same cycle/week.
     */
    public function getStreakCheckinsAttribute()
    {
        return self::where('user_id', $this->user_id)
            ->where('minggu_ke', $this->minggu_ke)
            ->orderBy('hari_ke')
            ->get();
    }
}
