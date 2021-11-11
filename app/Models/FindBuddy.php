<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FindBuddy extends Model
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'description',
    ];
    
    use HasFactory;
}
