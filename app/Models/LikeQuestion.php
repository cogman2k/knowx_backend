<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeQuestion extends Model
{
    protected $fillable=[
        'user_id',
        'question_id',
    ];  

    use HasFactory;
}
