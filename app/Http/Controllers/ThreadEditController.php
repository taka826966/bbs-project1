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
        // カスタムエラーメッセージを定義
        $customMessages = [
            'title.required' => 'タイトルを入力してください。',
            'title.max' => 'タイトルは100文字以内で入力してください。',
        ];

        // バリデーション
        $validated = $request->validate([
            'title' => 'required|max:100', //タイトルの入力必須 100文字まで
            'genre_id' => 'integer', //ジャンルの選択必須 整数
        ], $customMessages);

        // バリデーション通過で編集実行
        $thread->update($validated);

        // 成功メッセージをセッションに設定
        $request->session()->flash('success', 'スレッドが編集されました。');

        return redirect()->route('read', $thread);
    }
}