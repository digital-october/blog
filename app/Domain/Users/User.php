<?php

namespace App\Domain\Users;

use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Domain\Posts\Post;
use App\Domain\Comments\Comment;

use App\Domain\Users\Presenters\UserPresenter;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, PresentableTrait;

    protected $presenter = UserPresenter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function post(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
