<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_item_id',
        'user_id',
        'nama_pemohon',
        'kontak_pemohon',
        'alamat_pengiriman',
        'status',
    ];

    /**
     * Get the donation item being requested.
     */
    public function donationItem(): BelongsTo
    {
        return $this->belongsTo(DonationItem::class);
    }

    /**
     * Get the user who made the request (if logged in).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
