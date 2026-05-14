<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'is_home',
        'content',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $page): void {
            if ($page->is_home) {
                static::where('id', '!=', $page->id)->update(['is_home' => false]);
            }
        });
    }

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'is_home'  => 'boolean',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
