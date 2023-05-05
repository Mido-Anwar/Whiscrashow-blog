<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'detailes',
        'category_id',
    ];
    //relation between category and tag
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_tags');

    }
}
