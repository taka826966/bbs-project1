<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Post;

class ReadController extends Controller
{
    public function read(Thread $thread) {
        $posts = Post::where('thread_id', $thread->id)->get();
        return view('bbs.read', compact('thread', 'posts'));
    }

    public function delete(Post $post) {
        $post->delete();
        return back();
    }
}
