<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Thread;
use App\Models\Post;

class SearchController extends Controller
{
    public function searchWord(Request $request) {
        $word = $request->input('word');

        $threads = Thread::with('latestPost')->where('title', 'LIKE', "%{$word}%")->get()->sortByDesc(function ($thread) {
            return optional($thread->latestPost)->created_at ?? null;
        });

        return view('bbs.search_word', compact('threads', 'word'));
    }

    public function searchGenre(Request $request) {
        $genres=Genre::all();

        $selectedGenreId = $request->input('select');
    
        $threads = Thread::with('latestPost')->where("genre_id", $selectedGenreId)->get()->sortByDesc(function ($thread) {
            return optional($thread->latestPost)->created_at ?? null;
        });    
    
        $selectedGenre = Genre::find($selectedGenreId);

        return view('bbs.search_genre', compact('genres', 'threads', 'selectedGenre'));
    }
}
