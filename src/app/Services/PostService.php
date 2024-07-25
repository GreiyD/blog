<?php

namespace App\Services;

use App\Contracts\ImageStorageServiceContract;
use App\Enums\ReactionType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    protected object $imageStorageService;
    public function __construct(ImageStorageServiceContract $imageStorageService)
    {
        $this->imageStorageService = $imageStorageService;
    }

    public function getUserPosts(User $user): LengthAwarePaginator
    {
        return $user->posts()->withCount([
            'reactions as likes' => function ($query) {
                $query->where('type', ReactionType::Like->value);
            },
            'reactions as dislikes' => function ($query) {
                $query->where('type', ReactionType::Dislike->value);
            }
        ])->latest()->paginate(10);
    }

    public function getPost(int $postId): Post
    {
        return Post::withCount([
            'reactions as likes' => function ($query) {
                $query->where('type', ReactionType::Like->value);
            },
            'reactions as dislikes' => function ($query) {
                $query->where('type', ReactionType::Dislike->value);
            }
        ])->findOrFail($postId);
    }

    public function getAllPosts(): LengthAwarePaginator
    {
        return Post::with(['user:id,nickname', 'user.profile:id,photo_path,user_id'])->withCount([
            'reactions as likes' => function ($query) {
                $query->where('type', ReactionType::Like->value);
            },
            'reactions as dislikes' => function ($query) {
                $query->where('type', ReactionType::Dislike->value);
            }
        ])->latest()->paginate(10);
    }

    public function createPost(User $user, array $data): Post
    {
        $imgPath = isset($data['photo']) ? $this->imageStorageService->upload($data['photo'], 'post_photos') : null;
        $post = new Post([
            'title' => $data['title'],
            'content' => $data['content'],
            'status' => $data['status'],
            'photo_path' => $imgPath
        ]);

        return $user->posts()->save($post);
    }

    public function updatePost(int $postId, array $data): bool
    {
        $post = $this->getPost($postId);
        if(isset($data['photo'])){
            $data['photo_path'] = $this->imageStorageService->update($data['photo'], $post->photo_path, 'post_photos');
            unset($data['photo']);
        }

        return $post->update($data);
    }

    public function deletePost(int $postId): bool
    {
        $post = $this->getPost($postId);
        if(isset($post->photo_path)){
            $this->imageStorageService->delete($post->photo_path);
        }
        return $post->delete();
    }
}
