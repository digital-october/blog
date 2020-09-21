<?php

namespace App\Domain\Users;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Domain\Roles\Role;
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
        'patronymic',
        'email',
        'jobs',
        'urls',
        'password',
        'role',
        'activated_at'
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

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function verifyUser(): HasOne
    {
        return $this->hasOne(VerifyUser::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Determine whether the user has role.
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role) : bool
    {
        return $this->role->isRole($role);
    }

    /**
     * Determine if the user is root.
     *
     * @return bool
     */
    public function getIsRootAttribute()
    {
        return $this->role->is_root;
    }

    /**
     * Determine if the user is administrator.
     *
     * @return bool
     */
    public function getIsAdministratorAttribute()
    {
        return $this->role->is_administrator;
    }

    /**
     * Determine if the user is redactor.
     *
     * @return bool
     */
    public function getIsRedactorAttribute()
    {
        return $this->role->is_redactor;
    }

    /**
     * Determine if the user is writer.
     *
     * @return bool
     */
    public function getIsWriterAttribute()
    {
        return $this->role->is_writer;
    }

    /**
     * Determine if user has permission to do something.
     *
     * @param $permission
     *
     * @return bool
     */
    public function hasPermission($permission)
    {
        return $this->permissions->where('slug', $permission)->first();
    }
}
