<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Thread;
use App\Models\Post;

class SearchController extends Controller
{
    // ワード検索
    public function searchWord(Request $request) {
        // 入力ワードを取得
        $word = $request->input('word');
    
        // スレッドを取得
        $threads = $this->getThreadsByWord($word);
    
        // スレッドを並び替えてページネーションを適用
        $threads = $this->sortThreadsAndPaginate($threads, $word);
    
        return view('bbs.search_word', compact('threads', 'word'));
    }
    
    private function getThreadsByWord($word) {
        // 入力ワードに部分一致するスレッドタイトルを取得
        $threads = Thread::where('title', 'LIKE BINARY', "%{$word}%") // スレッドタイトルのみを検索対象にする
                         ->with(['latestPost' => function($query) {
                                $query->orderByDesc('created_at');
                            }])
                         ->get();
    
        return $threads;
    }
    
    private function sortThreadsAndPaginate($threads, $word) {
        // スレッドを最終投稿日時で降順に並び替え
        $threads = $threads->sortByDesc(function ($thread) {
            return optional($thread->latestPost)->created_at ?? null;
        });
        
        // ページネーションを適用
        $perPage = 20;
        $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
        $currentPageSearchResults = $threads->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $path = \Illuminate\Pagination\Paginator::resolveCurrentPath(); // 現在のURLを取得
        $threads = new \Illuminate\Pagination\LengthAwarePaginator($currentPageSearchResults, $threads->count(), $perPage, $currentPage);
        
        // 検索ワードを含める
        $threads->appends(['word' => $word]);

        // ベースURLを設定
        $threads->setPath($path);
        
        return $threads;
    }

    // ジャンル検索
    public function searchGenre(Request $request) {
        $genres = Genre::all();

        // 選択したジャンルを取得
        $selectedGenreId = $request->input('select');

    // ジャンルが選択されていない場合は全スレッドを取得
    if ($selectedGenreId) {
        // 選択したジャンルのスレッドタイトルと最終投稿日時を取得 最終投稿日時の降順に並び替え
        $threads = Thread::with('latestPost')->where("genre_id", $selectedGenreId)->get()->sortByDesc(function ($thread) {
            return optional($thread->latestPost)->created_at ?? null;
        });

        $selectedGenre = Genre::find($selectedGenreId);
    } else {
        // 全スレッドを取得 最終投稿日時の降順に並び替え
        $threads = Thread::with('latestPost')->get()->sortByDesc(function ($thread) {
            return optional($thread->latestPost)->created_at ?? null;
        });

        $selectedGenre = null;
    }

        // スレッドを並び替えてページネーションを適用
        $threads = $this->paginateThreads($threads);

        return view('bbs.search_genre', compact('genres', 'threads', 'selectedGenre'));
    }

    // スレッドをページネーションするメソッド
    private function paginateThreads($threads) {
        // スレッドを最終投稿日時で降順に並び替え
        $threads = $threads->sortByDesc(function ($thread) {
            return optional($thread->latestPost)->created_at ?? null;
        });

        // ページネーションを適用
        $perPage = 20;
        $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
        $currentPageSearchResults = $threads->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $path = \Illuminate\Pagination\Paginator::resolveCurrentPath(); // 現在のURLを取得
        $threads = new \Illuminate\Pagination\LengthAwarePaginator($currentPageSearchResults, $threads->count(), $perPage, $currentPage);

        // ベースURLを設定
        $threads->setPath($path);

        // 検索条件をクエリ文字列に追加
        $query = request()->query();
        unset($query['page']); // ページ番号は除外
        $threads->appends($query);

        return $threads;
    }
}
