<?php

namespace App\Domain\Users\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    public function fullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function accountAge(): string
    {
        return $this->created_at->diffForHumans();
    }
}