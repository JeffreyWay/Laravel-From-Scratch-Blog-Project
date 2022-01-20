<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::where('status', 'PUBLISHED')->latest()->filter(
                        request(['search', 'category', 'author'])
                    )->paginate(18)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        abort_if($post->status != "PUBLISHED", 404);

        return view('posts.show', [
            'post' => $post
        ]);
    }
}
