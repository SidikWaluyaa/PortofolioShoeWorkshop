<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name', 'location', 'service', 'source', 'reviewed_at', 'avatar', 'rating', 'content', 'is_active', 'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer',
        'order' => 'integer',
        'reviewed_at' => 'date',
    ];

    /**
     * "Julian Putra" -> "Julian P." so customers are not named in full on the site.
     */
    public function getShortNameAttribute(): string
    {
        $parts = preg_split('/\s+/', trim(mb_convert_case($this->name, MB_CASE_TITLE)));
        $first = array_shift($parts);

        return $parts ? $first . ' ' . mb_substr(end($parts), 0, 1) . '.' : $first;
    }
}