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
     * @return bool
     */
    public function isRole($role) : bool
    {
        return $this->slug === ($role instanceof self ? $role->slug : $role);
    }

    /**
     * IsRoot attribute getter.
     *
     * @return bool
     */
    public function getIsRootAttribute()
    {
        return $this->isRole(self::$root);
    }

    /**
     * IsAdministrator attribute getter.
     *
     * @return bool
     */
    public function getIsAdministratorAttribute()
    {
        return $this->isRole(self::$administrator);
    }

    /**
     * IsRedactor attribute getter.
     *
     * @return bool
     */
    public function getIsRedactorAttribute()
    {
        return $this->isRole(self::$redactor);
    }

    /**
     * IsWriter attribute getter.
     *
     * @return bool
     */
    public function getIsWriterAttribute()
    {
        return $this->isRole(self::$writer);
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


    /**
     * Scope a query to only include a root role.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return mixed
     */
    public function scopeRoot(Builder $query)
    {
        return $query->whereRole(self::$root);
    }

    /**
     * Scope a query to only include a $administrator role.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return mixed
     */
    public function scopeAdministrator(Builder $query)
    {
        return $query->whereRole(self::$administrator);
    }

    /**
     * Scope a query to only include a $redactor role.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return mixed
     */
    public function scopeRedactor(Builder $query)
    {
        return $query->whereRole(self::$redactor);
    }

    /**
     * Scope a query to only include a $writer role.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return mixed
     */
    public function scopeWriter(Builder $query)
    {
        return $query->whereRole(self::$writer);
    }
}
