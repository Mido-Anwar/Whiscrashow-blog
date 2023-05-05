<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'slug',
        'image',
        'tag_id',
        'category_id',
        'user_id',
    ];

    //relation between category and post
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Determine whether a post has been marked as favorite by a user.
     *
     * @return boolean
     */
    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
            ->where('post_id', $this->id)
            ->first();
    }
}
