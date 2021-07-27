<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'price',
        'approved',
        'is_public_vote',
        'is_public_comment',
        'commentable',
        'voteable'
    ];

    protected $appends = ['picture'];

    protected $casts = [
        'is_public_vote' => 'boolean',
        'is_public_comment' => 'boolean',
        'approved' => 'boolean',
        'commentable' => 'boolean',
        'voteable' => 'boolean',
    ];

    public function providers()
    {
        return $this->belongsToMany(Provider::class, 'product_provider', 'product_id', 'provider_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'product_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'product_id', 'id');
    }

    public function getPictureAttribute()
    {
        return (secure_asset('storage/' . $this->image));
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', '=', 1);
    }

    public function scopeVoteable($query)
    {
        return $query->where('voteable', '=', 1);
    }

    public function scopeCommentable($query)
    {
        return $query->where('commentable', '=', 1);
    }

    public function scopeIsPublicVote($query)
    {
        return $query->where('is_public_vote', '=', 1);
    }

    public function scopeIsPublicComment($query)
    {
        return $query->where('is_public_comment', '=', 1);
    }
}
