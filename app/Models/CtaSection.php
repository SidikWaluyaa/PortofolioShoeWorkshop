<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CtaSection extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'button_text', 'button_link', 'is_active'];
}
