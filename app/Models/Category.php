<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'detailes',
    ];

    //relation between category and tags

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }
    //relation between category and posts

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
