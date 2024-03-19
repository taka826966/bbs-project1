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

// bbs home
Route::get('bbs/home', [HomeController::class, 'home'])->name('home');

// bbs search_word
Route::get('bbs/search_word', [SearchController::class, 'searchWord'])->name('search.word');

// bbs search_genre
Route::get('bbs/search_genre', [SearchController::class, 'searchGenre'])->name('search.genre');

// bbs read
Route::get('bbs/read{thread}', [ReadController::class, 'read'])->name('read');

Route::delete('bbs/read{thread}', [ReadController::class, 'delete'])->name('delete');

// bbs thread_creation
Route::get('bbs/thread_creation', [ThreadCreationController::class, 'thread_creation'])->name('thread_creation');

Route::post('bbs/thread_creation', [ThreadCreationController::class, 'create'])->name('thread.create');

// bbs thread_edit
Route::get('bbs/thread_edit{thread}', [ThreadEditController::class, 'thread_edit'])->name('thread_edit');

Route::patch('bbs/thread_edit{thread}', [ThreadEditController::class, 'update'])->name('update');

// bbs post_creation
Route::get('bbs/post_creation{thread}', [PostCreationController::class, 'post_creation'])->name('post_creation');

Route::post('bbs/post_creation{thread}', [PostCreationController::class, 'create'])->name('post.create');

// テスト用
Route::get('test', [TestController::class, 'index'])->name('test.index');