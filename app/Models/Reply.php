<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    use \Conner\Likeable\Likeable;

    protected $fillable = [
        'content',
        'user_id',
        'parent_id',
    ];

    protected $attributes = [
    ];

    public static $rules = [
        'content' => 'required|string|max:500',
        'user_id' => 'required|integer|exists:user_id',
        'parent_id' => 'required|integer|exists:parent_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parent()
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }
}