<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Thread;
use App\Models\Post;

class ReadController extends Controller
{
    // 画面表示
    public function read(Thread $thread) {
        $posts = Post::where('thread_id', $thread->id)->paginate(20);
        $currentPage = HttpRequest::get('page', 1);
        return view('bbs.read', compact('thread', 'posts', 'currentPage'));
    }

    // コメント削除
    public function delete(Thread $thread, Post $post) {
        $post->delete();
        return redirect()->route('read', ['thread' => $thread->id])
        ->with('success', 'コメントが正常に削除されました。');
    }
}