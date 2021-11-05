<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'hastag',
        'content',
        'user_id',
        'like',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function likequestions()
    {
        return $this->belongsToMany(LikeQuestion::class);
    }
}
