<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Thread;
use Symfony\Component\HttpFoundation\Response;

class ThreadEditMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ルートからスレッドモデルを取得
        $thread = $request->route('thread');

        // ログインユーザーが管理者であるか、スレッドの作成者であるかをチェック
        if(auth()->user()->role == 'admin' || auth()->user()->id == $thread->user_id) {
            return $next($request);
        }

        // 条件に合致しない場合、ホームページにリダイレクト
        return redirect()->route('home');
    }
}
