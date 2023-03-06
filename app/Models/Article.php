<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $perPage = 6;

    protected $fillable = [
        'title',
        'description',
        'content',
        'is_active'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
