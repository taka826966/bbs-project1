<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'genre_id',
        'user_id',
    ];

    // Userへリレーション
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Postへリレーション 最終投稿日時取得のため
    public function latestPost() {
        return $this->hasOne(Post::class)->latest();
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
