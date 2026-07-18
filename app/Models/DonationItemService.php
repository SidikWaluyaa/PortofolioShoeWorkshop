<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonationItemService extends Model
{
    use HasFactory;

    protected $table = 'donation_item_services';

    protected $fillable = [
        'donation_item_id',
        'service_id',
        'jasa_nama_manual',
        'jasa_harga',
        'jasa_estimasi_waktu',
        'is_mandatory',
    ];

    protected $appends = [
        'jasa_nama',
        'jasa_harga_formatted',
        'jasa_estimasi_waktu_formatted',
    ];

    /**
     * Get the service relation.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the service name (either from formal service model or manually inputted).
     */
    public function getJasaNamaAttribute(): ?string
    {
        if (!empty($this->jasa_nama_manual)) {
            return $this->jasa_nama_manual;
        }

        if ($this->service_id && $this->service) {
            return $this->service->name;
        }

        return null;
    }

    /**
     * Get the formatted price of the service.
     */
    public function getJasaHargaFormattedAttribute(): string
    {
        if (is_null($this->jasa_harga) || $this->jasa_harga === 0) {
            return 'Gratis / N/A';
        }
        return 'Rp ' . number_format($this->jasa_harga, 0, ',', '.');
    }

    /**
     * Get the formatted estimation time.
     */
    public function getJasaEstimasiWaktuFormattedAttribute(): string
    {
        if (is_null($this->jasa_estimasi_waktu) || $this->jasa_estimasi_waktu === 0) {
            return 'N/A';
        }
        return $this->jasa_estimasi_waktu . ' Hari';
    }
}
