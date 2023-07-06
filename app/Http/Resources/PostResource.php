<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'category' => $this->category ? $this->category->name : '',
            'postFavorite' => $this->favorited(),
             'postTags' => $this->tags->transform(function ($tag) {
                 return [
                     'name' => $tag->name,
                 ];
             }),
         ];
    }
}
