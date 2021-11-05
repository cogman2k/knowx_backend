<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeQuestion extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'question_id',
    ];  

    public function questions()
    {
    return $this->belongsToMany(Question::class);
    }
}
