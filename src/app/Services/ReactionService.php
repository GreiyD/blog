<?php

namespace App\Services;

use App\Contracts\Reactionable;
use App\Enums\ReactionType;

class ReactionService
{
    public function toggleReaction(Reactionable $reactionable, int $userId, ReactionType $type): void
    {
        $existingReaction = $reactionable->reactions()->where('user_id', $userId)->first();
        if ($existingReaction) {
            if ($existingReaction->type === $type) {
                $existingReaction->delete();
            } else {
                $existingReaction->update(['type' => $type->value]);
            }
        } else {
            $reactionable->reactions()->create([
                'user_id' => $userId,
                'type' => $type->value,
            ]);
        }
    }

    public function getLikesCount(Reactionable $reactionable): int
    {
        return $reactionable->likes()->count();
    }

    public function getDislikesCount(Reactionable $reactionable): int
    {
        return $reactionable->dislikes()->count();
    }
}
