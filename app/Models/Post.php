<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [ "title", "picture", "content" ];

    
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->latest();
    }
}