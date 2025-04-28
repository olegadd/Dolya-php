<?php

namespace App\Services;

use App\Models\Posts\Post;

class PostService
{
    public function store(array $data, int $userId): Post
    {
        $data['user_id'] = $userId;
        return Post::create($data);
    }

    public function update(Post $post, array $data): Post
    {
        $post->update($data);
        return $post;
    }

    public function delete(Post $post): void
    {
        $post->delete();
    }
}
