<?php

namespace App\Domain\Posts;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    protected $fillable = ['created_at'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
