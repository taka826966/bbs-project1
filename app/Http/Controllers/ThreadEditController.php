<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Thread;

class ThreadEditController extends Controller
{
    public function thread_edit(Thread $thread) {
        $genres=Genre::all();
        return view('bbs.thread_edit', compact('genres', 'thread'));
    }

    public function update(Request $request, Thread $thread) {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'genre_id' => 'integer',
        ]);

        $thread->update($validated);

        return back();
    }
}
