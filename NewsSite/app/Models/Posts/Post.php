<?php

namespace App\Models\Posts;

use App\Models\Comments\Comment;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content'
    ];

    protected static function booted(): void
    {
        static::created(function (Post $post) {
            Log::channel('changes')->info('Пост создан', [
                'id' => $post->id,
                'title' => $post->title,
                'user_id' => $post->user_id,
            ]);
        });

        static::updated(function (Post $post) {
            Log::channel('changes')->info('Пост обновлен', [
                'id' => $post->id,
                'title' => $post->title,
                'user_id' => $post->user_id,
                'changes' => $post->getChanges(),
            ]);
        });

        static::deleted(function (Post $post) {
            Log::channel('changes')->info('Пост удален', [
                'id' => $post->id,
                'title' => $post->title,
                'user_id' => $post->user_id,
            ]);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
