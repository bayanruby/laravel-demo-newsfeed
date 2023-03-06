<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $perPage = 50;

    protected $fillable = [
        'name',
        'slug',
        'is_active'
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function scopeActive(Builder $query)
    {
        $query->where('is_active', 1);
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::slug($value, '-'),
        );
    }
}
