<?php

namespace App\Models\Users;

use App\Models\Comments\Comment;
use App\Models\Posts\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected static function booted(): void
    {
        static::created(function (User $user) {
            Log::channel('changes')->info('Пользователь создан', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        });

        static::updated(function (User $user) {
            Log::channel('changes')->info('Пользователь обновлен', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'changes' => $user->getChanges(),
            ]);
        });

        static::deleted(function (User $user) {
            Log::channel('changes')->info('Пользователь удален', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
