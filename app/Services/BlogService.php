<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Str;

class BlogService
{
    public function getActive($limit = null)
    {
        $query = Post::where('status', 'published')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc');
        
        return $limit ? $query->limit($limit)->get() : $query->get();
    }

    public function getAll()
    {
        return Post::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        
        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return Post::create($data);
    }

    public function update(Post $post, array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($data['status'] === 'published' && empty($post->published_at)) {
            $data['published_at'] = now();
        }

        $post->update($data);
        return $post;
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}
