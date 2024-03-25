<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // 画面表示
    public function home() {
        return view('bbs.home');
    }
}
