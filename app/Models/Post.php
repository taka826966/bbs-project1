<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'thread_id',
        'comment',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
