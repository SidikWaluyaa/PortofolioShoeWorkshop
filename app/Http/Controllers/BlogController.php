<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\BlogService;
use App\Services\SettingService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(
        protected BlogService $blogService,
        protected SettingService $settingService
    ) {}

    public function index()
    {
        $posts = $this->blogService->getActive();
        $settings = $this->settingService->all();
        return view('blog.index', compact('posts', 'settings'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->limit(3)
            ->get();
        
        $settings = $this->settingService->all();
        
        return view('blog.show', compact('post', 'relatedPosts', 'settings'));
    }
}
