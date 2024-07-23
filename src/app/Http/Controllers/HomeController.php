<?php

namespace App\Http\Controllers;

use App\Services\PostService;

class HomeController extends Controller
{
    protected object $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('home', compact('posts'));
    }
}
