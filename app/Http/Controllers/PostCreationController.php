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
        // コメントのバリデーション
        $validated = $this->validateComment($request);

        // バリデーションを通過したデータの追加準備
        $validated = $this->prepareData($validated, $thread);

        // コメントの作成
        $post = Post::create($validated);

        // コメント投稿が成功した場合にセッションから入力コメントを削除
        $this->clearCommentFromSession($request);

        // 成功メッセージをセッションに設定
        $request->session()->flash('success', 'コメントが投稿されました。');

        $lastPage = $thread->posts()->paginate(20)->lastPage();
        return redirect()->route('read', [$thread, 'page' => $lastPage])->with('scroll_to', 'bottom');
    }

    // コメントのバリデーションを実行するメソッド
    private function validateComment(Request $request) {
        // カスタムエラーメッセージの定義
        $customMessages = [
            'comment.required' => 'コメント内容を入力してください。',
            'comment.max' => 'コメント内容は300文字以内で入力してください。',
        ];

        return $request->validate([
            // バリデーションルールの定義
            'comment' => 'required|max:300', // コメント内容の入力必須 最大300文字まで
        ], $customMessages);
    }

    // 投稿に関するデータを準備するメソッド
    private function prepareData(array $validated, Thread $thread) {
        // スレッドIDを取得
        $validated['thread_id'] = $thread->id;

        // ログインユーザーのIDを取得
        $validated['user_id'] = auth()->id();

        return $validated;
    }

    // セッションからコメントを削除するメソッド
    private function clearCommentFromSession(Request $request) {
        $request->session()->forget('comment');
    }
}
