<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\BlogService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(protected BlogService $blogService) {}

    public function index()
    {
        $posts = $this->blogService->getAll();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'thumbnail' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $this->blogService->create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Article created successfully.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
            'thumbnail' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $this->blogService->update($post, $data);

        return redirect()->route('admin.posts.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Post $post)
    {
        $this->blogService->delete($post);
        return redirect()->route('admin.posts.index')->with('success', 'Article deleted successfully.');
    }
}
