<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    protected object $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request): View
    {
        $user = $request->user;
        $posts = $this->postService->getUserPosts($user);

        return view('post.index', compact('posts'));
    }

    public function store(PostRequest $request, PostService $postService): RedirectResponse
    {
        $data = $request->only('title', 'content', 'status', 'photo');
        $user = $request->user;
        $postService->createPost($user, $data);

        return redirect()->route('posts.index');
    }

    public function show($postId): View
    {
        $post = $this->postService->getPost($postId);
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
}
