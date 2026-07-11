<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_item_id',
        'user_id',
        'nama_pemohon',
        'email',
        'kontak_pemohon',
        'alamat_pengiriman',
        'alasan',
        'selected_services',
        'status',
        'bukti_pembayaran',
        'resi_pengiriman',
    ];

    protected $casts = [
        'selected_services' => 'array',
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

    /**
     * Scope a query to apply filters from Request.
     */
    public function scopeFilterByRequest(Builder $query, \Illuminate\Http\Request $request)
    {
        // 1. Search (omni-search)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_pemohon', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('kontak_pemohon', 'like', "%{$search}%")
                  ->orWhereHas('donationItem', function ($itemQuery) use ($search) {
                      $itemQuery->where('nama', 'like', "%{$search}%")
                               ->orWhere('kode_barang', 'like', "%{$search}%");
                  });
            });
        }

        // 2. Status
        if ($request->filled('status')) {
            $query->where('status', '=', $request->input('status'));
        }

        // 3. Kategori
        if ($request->filled('kategori')) {
            $kategori = $request->input('kategori');
            $query->whereHas('donationItem', function ($itemQuery) use ($kategori) {
                $itemQuery->where('kategori', '=', $kategori);
            });
        }

        // 4. Tipe Pengaju
        if ($request->filled('tipe_pengaju')) {
            $tipe = $request->input('tipe_pengaju');
            if ($tipe === 'registered') {
                $query->whereNotNull('user_id');
            } elseif ($tipe === 'guest') {
                $query->whereNull('user_id');
            }
        }

        // 5. Date Range (e.g. "2026-06-01 to 2026-06-27")
        if ($request->filled('date_range')) {
            $range = $request->input('date_range');
            if (str_contains($range, ' to ')) {
                $parts = explode(' to ', $range);
                $startDate = trim($parts[0]);
                $endDate = trim($parts[1]);
                $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            } else {
                $date = trim($range);
                $query->whereBetween('created_at', [$date . ' 00:00:00', $date . ' 23:59:59']);
            }
        }

        return $query;
    }

    /**
     * Scope a query to apply sorting from Request.
     */
    public function scopeSortByRequest(Builder $query, \Illuminate\Http\Request $request)
    {
        $sort = $request->input('sort', 'latest');
        
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('nama_pemohon', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nama_pemohon', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query;
    }
}
