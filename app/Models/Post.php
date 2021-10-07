<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'hastag',
        'content',
        'user_id',
        // 'completed',
        // 'active'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}