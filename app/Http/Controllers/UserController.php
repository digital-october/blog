<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        return view('users.show', [
            'users' => User::get()
        ]);
    }

    public function makeAdmin(User $user)
    {
        $user->update([
            'role' => 'admin'
        ]);

        return redirect()->back();
    }

    public function dismiss(User $user)
    {
        $user->update([
            'role' => null
        ]);

        return redirect()->back();
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back();
    }
}
