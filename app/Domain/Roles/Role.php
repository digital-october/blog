<?php

namespace App\Domain\Roles;

use Illuminate\Database\Eloquent\Builder;

use App\Domain\Users\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static $root = 'root';
    public static $administrator = 'administrator';
    public static $writer = 'writer';
    public static $redactor = 'redactor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'name'
    ];

    /**
     * Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Check role.
     *
     * @param $role
     *
     * @return bool
     */
    public function isRole($role)
    {
        return $this->slug === ($role instanceof self ? $role->slug : $role);
    }

    /**
     * Scope a query to only include a given role.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Domain\Roles\Role|string $role
     *
     * @return mixed
     */
    public function scopeWhereRole(Builder $query, $role)
    {
        $slug = $role instanceof self ? $role->slug : $role;

        return $query->whereSlug($slug);
    }
}
