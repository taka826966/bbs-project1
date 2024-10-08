<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\ThreadCreationController;
use App\Http\Controllers\ThreadEditController;
use App\Http\Controllers\PostCreationController;
use App\Http\Controllers\TestController;
use App\Models\Thread;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Language Switcher Route 言語切替用ルートだよ
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
});

// bbs ホーム
Route::get('bbs/home', [HomeController::class, 'home'])->name('home');

// bbs ワード検索
Route::get('bbs/search_word', [SearchController::class, 'searchWord'])->name('search.word');

// bbs ジャンル検索
Route::get('bbs/search_genre', [SearchController::class, 'searchGenre'])->name('search.genre');

// bbs スレッド閲覧
Route::get('bbs/read{thread}', [ReadController::class, 'read'])->name('read');

Route::delete('bbs/read{thread}/post/{post}', [ReadController::class, 'delete'])->name('delete');

// bbs スレッド作成
Route::get('bbs/thread_creation', [ThreadCreationController::class, 'thread_creation'])->name('thread_creation')->middleware('auth');

Route::post('bbs/thread_creation', [ThreadCreationController::class, 'create'])->name('thread.create');

// bbs スレッド編集
Route::get('bbs/thread_edit{thread}', [ThreadEditController::class, 'thread_edit'])->name('thread_edit')->middleware('auth', 'admin');

Route::patch('bbs/thread_edit{thread}', [ThreadEditController::class, 'update'])->name('update');

// bbs コメント作成
Route::get('bbs/post_creation{thread}', [PostCreationController::class, 'post_creation'])->name('post_creation')->middleware('auth');

Route::post('bbs/post_creation{thread}', [PostCreationController::class, 'create'])->name('post.create');

// bbs テスト用
Route::get('test', [TestController::class, 'index'])->name('test.index');