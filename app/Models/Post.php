<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        // 'likes',
        'user_id'
    ];

    protected $attributes = [
        'likes' => 0,
        'replies' => 0,
        'reposts' => 0
    ];

    public static $rules = [
        'content' => 'required|string|max:500',
        'user_id' => 'required|integer|exists:user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}