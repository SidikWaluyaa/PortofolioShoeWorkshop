<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'description', 'service_id', 'before_image', 'after_image', 'is_featured', 'is_active'];
}
