<?php

namespace App\Domain\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    public static $rejected = 'rejected';
    public static $rework = 'rework';
    public static $accepted = 'accepted';
    public static $check = 'check';
    public static $waiting_moderation = 'waiting_moderation';

    public $timestamps = false;


    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    public static function getSlugID($slug)
    {
        return self::whereSlug($slug)->get()->first()->id;
    }
}
