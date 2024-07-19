<?php

namespace App\Services;

use App\Contracts\ImageStorageServiceContract;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    protected object $imageStorageService;
    public function __construct(ImageStorageServiceContract $imageStorageService)
    {
        $this->imageStorageService = $imageStorageService;
    }

    public function getUserPosts(User $user): Collection
    {
        return $user->posts()->latest()->get();
    }

    public function getPost(int $postId): Post
    {
        return Post::findOrFail($postId);
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
