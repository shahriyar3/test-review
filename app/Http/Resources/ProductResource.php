<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
            'price' => $this->price,
            'public_vote' => $this->is_public_vote,
            'public_comment' => $this->is_public_comment,
            'open_comment' => $this->commentable,
            'open_vote' => $this->voteable,
            'vote' => $this->votes_avg_vote,
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
