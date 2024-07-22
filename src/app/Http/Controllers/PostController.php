<?php

namespace App\Http\Controllers;

use App\Enums\ReactionType;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use App\Services\ReactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    protected object $postService;
    protected object $reactionService;

    public function __construct(PostService $postService, ReactionService $reactionService)
    {
        $this->postService = $postService;
        $this->reactionService = $reactionService;
    }

    public function index(Request $request): View
    {
        $user = $request->user;
        $posts = $this->postService->getUserPosts($user);
        $posts->each(function($post) {
            $post->likes = $this->reactionService->getLikesCount($post);
            $post->dislikes = $this->reactionService->getDislikesCount($post);
        });

        return view('post.index', compact('posts'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $data = $request->only('title', 'content', 'status', 'photo');
        $user = $request->user;
        $this->postService->createPost($user, $data);

        return redirect()->route('posts.index');
    }

    public function show($postId): View
    {
        $post = $this->postService->getPost($postId);
        $post->likes = $this->reactionService->getLikesCount($post);
        $post->dislikes = $this->reactionService->getDislikesCount($post);

        return view('post.show', compact('post'));
    }

    public function destroy($postId): RedirectResponse
    {
        $this->postService->deletePost($postId);
        return redirect()->route('posts.index');
    }

    public function edit($postId): View
    {
        $post = $this->postService->getPost($postId);
        return view('post.edit', compact('post'));
    }

    public function update(PostRequest $request, $postId): RedirectResponse
    {
        $data = $request->only('title', 'content', 'photo');
        $this->postService->updatePost($postId, $data);

        return redirect()->route('posts.index');
    }

    public function handleReaction(Request $request, int $postId): RedirectResponse
    {
        $user = $request->user;
        $reactionType = ReactionType::from($request->input('reaction'));
        $post = $this->postService->getPost($postId);

        $this->reactionService->toggleReaction($post, $user->id, $reactionType);

        return redirect()->back();
    }
}
