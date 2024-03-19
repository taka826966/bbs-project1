<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Post;

class PostCreationController extends Controller
{
    public function post_creation(Thread $thread) {
        return view('bbs.post_creation', compact('thread'));
    }

    public function create(Request $request, Thread $thread) {
        $validated = $request->validate([
            'comment' => 'required',
        ]);

        $validated['thread_id'] = $thread->id;
        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);
        return back();
    }
}
