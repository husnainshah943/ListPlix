<?php
namespace App\Repository;

use App\Models\User;
use App\Repository\Interfaces\UserProfileInterface;

class UserProfileRepository implements UserProfileInterface
{

    public function all_users()
    {
        $user = User::all();
        return $user;
    }
    public function user_info()
    {
        $user = auth()->user();
        return $user;
    }
}
