<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'order',
        'name',
        'subtitle',
        'description',
        'value_material',
        'value_kehidupan',
        'cta'
    ];

    public function services()
    {
        return $this->hasMany(LayananService::class)->orderBy('order');
    }
}
