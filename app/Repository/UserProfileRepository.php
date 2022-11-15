<?php
namespace App\Repository;

use App\Models\User;
use App\Repository\Interfaces\ContactUsInterface;
use App\Repository\Interfaces\UserProfileInterface;

class UserProfileRepository implements UserProfileInterface
{

    public function all_users()
    {
        $response = User::all();
        return $response;
    }
    public function user_info()
    {
        $response = auth()->user();
        return $response;
    }

}
