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
        // バリデーションを実行
        $this->validateThread($request);

        // リクエストデータを処理して検証済みデータを取得
        $validatedData = $this->processThreadData($request);

        // 検証済みデータを使用して新しいスレッドを作成し、データベースに保存
        $thread = Thread::create($validatedData);

        // 成功メッセージをセッションに設定
        $request->session()->flash('success', 'スレッドが作成されました。');

        return redirect()->route('read', $thread);
    }

    // スレッドのバリデーション実行メソッド
    protected function validateThread(Request $request) {
        // カスタムエラーメッセージの定義
        $customMessages = [
            'title.required' => 'タイトルを入力してください。',
            'title.max' => 'タイトルは100文字以内で入力してください。',
            'genre_id.required' => 'ジャンルを選択してください。',
            'genre_id.integer' => 'ジャンルを選択してください。',
        ];

        return $request->validate([
            // バリデーションルールの定義
            'title' => 'required|max:100', 
            'genre_id' => 'required|integer',
        ], $customMessages);
    }

    // スレッドデータの加工
    protected function processThreadData(Request $request) {
        // バリデーション済みのリクエストデータを取得
        $validatedData = $request->only(['title', 'genre_id']);

        // ログインユーザーのIDを取得
        $validatedData['user_id'] = auth()->id();

        return $validatedData;
    }
}
