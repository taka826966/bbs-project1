<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Post;

class PostCreationController extends Controller
{
    // 画面表示
    public function post_creation(Thread $thread) {
        return view('bbs.post_creation', compact('thread'));
    }

    // コメント投稿
    public function create(Request $request, Thread $thread) {
        // バリデーション
        $validated = $request->validate([
            'comment' => 'required', // コメント内容の入力必須
        ]);

        // スレッドIDを取得
        $validated['thread_id'] = $thread->id;

        // ログインユーザーのIDを取得
        $validated['user_id'] = auth()->id();

        // バリデーション通過で作成実行
        $post = Post::create($validated);

        return back();
    }
}
