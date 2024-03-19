<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Thread;

class ThreadCreationController extends Controller
{
    public function thread_creation() {
        $genres=Genre::all();
        return view('bbs.thread_creation', compact('genres'));
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'genre_id' => 'required|integer',
        ]);

        $validated['user_id'] = auth()->id();

        $thread = Thread::create($validated);

        return back();
    }
}
