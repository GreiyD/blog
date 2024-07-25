<?php

namespace App\Models;

use App\Contracts\Reactionable;
use App\Enums\PostStatus;
use App\Enums\ReactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model implements Reactionable
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'status',
        'photo_path',
    ];
    protected $appends = [
        'likes',
        'dislikes'
    ];
    protected $casts = [
        'status' => PostStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reactions(): MorphMany
    {
        return $this->morphMany(Reaction::class, 'reactionable');
    }

    public function likes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('type', ReactionType::Like);
    }

    public function dislikes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('type', ReactionType::Dislike);
    }

    public function getLikesAttribute()
    {
        return $this->attributes['likes'] ?? null;
    }

    public function getDislikesAttribute()
    {
        return $this->attributes['dislikes'] ?? null;
    }
}
