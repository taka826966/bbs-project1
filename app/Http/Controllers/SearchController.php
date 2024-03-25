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

        // 入力ワードに部分一致するスレッドタイトルと最終投稿日時を取得 最終投稿日時の降順に並び替え
        $threads = Thread::with('latestPost')->where('title', 'LIKE', "%{$word}%")->get()->sortByDesc(function ($thread) {
            return optional($thread->latestPost)->created_at ?? null;
        });

        return view('bbs.search_word', compact('threads', 'word'));
    }

    // ジャンル検索
    public function searchGenre(Request $request) {
        $genres=Genre::all();

        // 選択したジャンルを取得
        $selectedGenreId = $request->input('select');
    
        // 選択したジャンルのスレッドタイトルと最終投稿日時を取得 最終投稿日時の降順に並び替え
        $threads = Thread::with('latestPost')->where("genre_id", $selectedGenreId)->get()->sortByDesc(function ($thread) {
            return optional($thread->latestPost)->created_at ?? null;
        });    
    
        $selectedGenre = Genre::find($selectedGenreId);

        return view('bbs.search_genre', compact('genres', 'threads', 'selectedGenre'));
    }
}
