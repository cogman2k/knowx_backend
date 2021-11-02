<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Overtrue\LaravelFollow\Traits\CanBeBookmarked;
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
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function bookmarks()
    {
    return $this->belongsToMany(Bookmark::class);
    }
   
   public function is_bookmarked(User $user){
       return $this->bookmarks->contains($user);
   }
}