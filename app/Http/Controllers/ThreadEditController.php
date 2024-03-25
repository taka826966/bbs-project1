<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Thread;

class ThreadEditController extends Controller
{
    // 画面表示
    public function thread_edit(Thread $thread) {
        $genres=Genre::all();
        return view('bbs.thread_edit', compact('genres', 'thread'));
    }

    // スレッド編集
    public function update(Request $request, Thread $thread) {
        // バリデーション
        $validated = $request->validate([
            'title' => 'required|max:100', //タイトルの入力必須 100文字まで
            'genre_id' => 'integer', //ジャンルの選択必須 整数
        ]);

        // バリデーション通過で編集実行
        $thread->update($validated);

        return back();
    }
}