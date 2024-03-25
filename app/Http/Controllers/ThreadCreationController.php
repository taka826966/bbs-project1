<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Thread;

class ThreadCreationController extends Controller
{
    // 画面表示
    public function thread_creation() {
        $genres=Genre::all();
        return view('bbs.thread_creation', compact('genres'));
    }

    // スレッド作成
    public function create(Request $request) {
        // バリデーション
        $validated = $request->validate([
            'title' => 'required|max:100', //タイトルの入力必須 100文字まで
            'genre_id' => 'required|integer', //ジャンルの選択必須 整数
        ]);

        // ログインユーザーのIDを取得
        $validated['user_id'] = auth()->id();

        // バリデーション通過で作成実行
        $thread = Thread::create($validated);

        return back();
    }
}
