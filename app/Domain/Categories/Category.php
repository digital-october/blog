<?php

namespace App\Domain\Categories;

use App\Domain\Posts\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function posts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class)
            ->using(CategoryPost::class)
            ->withTimestamps();
    }
}
