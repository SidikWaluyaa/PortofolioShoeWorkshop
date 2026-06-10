<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'description', 'service_id', 'before_image', 'after_image', 'is_featured', 'is_active'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getBeforeImageUrlAttribute()
    {
        if (empty($this->before_image)) {
            return 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80';
        }
        if (\Illuminate\Support\Str::startsWith($this->before_image, ['http://', 'https://'])) {
            return $this->before_image;
        }
        if (\Illuminate\Support\Str::startsWith($this->before_image, 'images/portfolio/')) {
            return asset($this->before_image);
        }
        return asset('storage/' . $this->before_image);
    }

    public function getAfterImageUrlAttribute()
    {
        if (empty($this->after_image)) {
            return 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de?auto=format&fit=crop&w=600&q=80';
        }
        if (\Illuminate\Support\Str::startsWith($this->after_image, ['http://', 'https://'])) {
            return $this->after_image;
        }
        if (\Illuminate\Support\Str::startsWith($this->after_image, 'images/portfolio/')) {
            return asset($this->after_image);
        }
        return asset('storage/' . $this->after_image);
    }
}
