<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\StoreCommentRequest;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Posts\Post;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    protected $postService;
    protected $commentService;

    public function __construct(PostService $postService, CommentService $commentService)
    {
        $this->postService = $postService;
        $this->commentService = $commentService;
    }

    public function index(): View
    {
        $posts = Post::with('user')->get();
        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $this->postService->store($request->validated(), Auth::id());
        return redirect()->route('posts.index')->with('success', 'Пост создан успешно.');
    }

    public function show(Post $post): View
    {
        $post->load('user', 'comments.user');
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        return view('posts.create', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->postService->update($post, $request->validated());
        return redirect()->route('posts.index')->with('success', 'Пост обновлен успешно.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->postService->delete($post);
        return redirect()->route('posts.index')->with('success', 'Пост удален успешно.');
    }
}
