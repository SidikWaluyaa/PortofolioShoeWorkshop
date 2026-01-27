<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    /** @use HasFactory<\Database\Factories\HeroSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'primary_cta_text',
        'primary_cta_link',
        'secondary_cta_text',
        'secondary_cta_link',
        'image',
        'is_active',
    ];
}
