<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrustItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'label',
        'is_active',
        'order',
    ];
}
