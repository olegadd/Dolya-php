<?php

namespace App\Services;

use App\Models\Posts\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function store(array $data, ?int $userId = null): Post
    {
        $userId = $userId ?? Auth::id();
        if (!$userId) {
            throw new \Exception('Пользователь не авторизован для создания поста.');
        }

        $data['user_id'] = $userId;
        $post = Post::create($data);

        if (isset($data['featured_image'])) {
            $post->addMedia($data['featured_image'])->toMediaCollection('featured_image');
        }

        return $post;
    }

    public function update(Post $post, array $data): Post
    {
        $post->update($data);

        if (isset($data['featured_image'])) {
            $post->clearMediaCollection('featured_image');
            $post->addMedia($data['featured_image'])->toMediaCollection('featured_image');
        }

        return $post;
    }

    public function delete(Post $post): void
    {
        $post->delete();
    }
}
