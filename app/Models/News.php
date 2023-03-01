<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public const PAGINATION_COUNT = 6;

    protected $fillable = [
        'title',
        'description',
        'content'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}
