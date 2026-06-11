<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'avatar_path',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the donations made by this user.
     */
    public function donations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Get the daily check-in logs for this user.
     */
    public function dailyLogins(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DailyLogin::class);
    }

    /**
     * Get the reward claims made by this user.
     */
    public function userRewards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserReward::class);
    }

    /**
     * Mutator to ensure phone starts with '62' prefix.
     */
    public function setPhoneAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['phone'] = null;
            return;
        }

        // Remove non-numeric characters
        $cleaned = preg_replace('/[^0-9]/', '', $value);

        if (str_starts_with($cleaned, '0')) {
            $cleaned = '62' . substr($cleaned, 1);
        } elseif (!str_starts_with($cleaned, '62')) {
            $cleaned = '62' . $cleaned;
        }

        $this->attributes['phone'] = $cleaned;
    }
}
