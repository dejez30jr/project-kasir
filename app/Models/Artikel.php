<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikels';
    protected $fillable = [
        'title',
        'content',
        'author',
        'slug',
        'kategori',
    ];

     protected static function boot()
    {
        parent::boot();

        // saat membuat data baru
        static::creating(function ($artikel) {
            $artikel->slug = static::generateUniqueSlug($artikel->title);
        });

        // kalau judul di-update, slug juga ikut diubah
        static::updating(function ($artikel) {
            $artikel->slug = static::generateUniqueSlug($artikel->title, $artikel->id);
        });
    }

    // fungsi bantu buat bikin slug unik
    protected static function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'like', "{$slug}%")
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}
