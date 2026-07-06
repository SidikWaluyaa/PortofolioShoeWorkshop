<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananService extends Model
{
    use HasFactory;

    protected $fillable = [
        'layanan_category_id',
        'slug',
        'name',
        'subtitle_teknis',
        'kapan',
        'proses',
        'kenapa_penting',
        'image_before',
        'image_after',
        'is_preview',
        'order'
    ];

    public function category()
    {
        return $this->belongsTo(LayananCategory::class, 'layanan_category_id');
    }
}
