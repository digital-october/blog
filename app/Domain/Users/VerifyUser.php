<?php

namespace App\Domain\Users;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
