<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    /**
     * Shoe problems shown as the "Klinik Sepatu" picker on the home page,
     * each linked to the /layanan categories that fix it.
     */
    public const KELUHAN = [
        'sol-lepas'     => ['label' => 'Sol mangap / lepas',  'layanan' => ['lem-jahit', 'sol']],
        'sol-aus'       => ['label' => 'Sol aus / licin',     'layanan' => ['sol']],
        'menguning'     => ['label' => 'Sol menguning',       'layanan' => ['treatment']],
        'warna-pudar'   => ['label' => 'Warna pudar / kusam', 'layanan' => ['treatment']],
        'jahitan-lepas' => ['label' => 'Jahitan lepas',       'layanan' => ['lem-jahit', 'upper']],
        'lining-sobek'  => ['label' => 'Lapisan dalam sobek', 'layanan' => ['upper']],
    ];

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'content',
        'category',
        'keluhan',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getThumbnailUrlAttribute(): ?string
    {
        if (empty($this->thumbnail)) {
            return null;
        }
        if (Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
            return $this->thumbnail;
        }
        if (Str::startsWith($this->thumbnail, 'images/')) {
            return asset($this->thumbnail);
        }
        return asset('storage/' . $this->thumbnail);
    }

    /**
     * Article body written in Markdown (## subjudul, - poin). Plain text with line breaks still renders as before.
     */
    public function getBodyHtmlAttribute(): string
    {
        return Str::markdown((string) $this->content, [
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
            'renderer' => ['soft_break' => "<br>\n"],
        ]);
    }

    public function getPlainTextAttribute(): string
    {
        return trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($this->body_html), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
    }

    public function getReadingMinutesAttribute(): int
    {
        return max(1, (int) ceil(str_word_count($this->plain_text) / 200));
    }

    public function getKeluhanLabelAttribute(): ?string
    {
        return self::KELUHAN[$this->keluhan]['label'] ?? null;
    }
}
