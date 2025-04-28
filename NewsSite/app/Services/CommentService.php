<?php

namespace App\Services;

use App\Models\Comments\Comment;

class CommentService
{
    public function store(array $data, int $userId, int $postId): Comment
    {
        $data['user_id'] = $userId;
        $data['post_id'] = $postId;
        return Comment::create($data);
    }
}
