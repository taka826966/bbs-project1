<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Thread;

class TestController extends Controller
{
    public function index(Request $request) {
        $genres=Genre::all();

        if ($request->has('keyword-button')) {
            if(isset($request->keyword)) {
                $threads = Thread::where("title", "LIKE", "%$request->keyword%")->get();
            }
            else {
                $threads = Thread::get();
            }
        } elseif ($request->has('genre-button')) {
            $threads = Thread::where("genre_id", "$request->select")->get();
            //$genreselect = $request->input('genreselect');
        } else {
            $threads = Thread::get();
        }
 
        return view('test.test', compact('genres'), ['threads' => $threads, 'keyword' => $request->keyword]);
    }
}
