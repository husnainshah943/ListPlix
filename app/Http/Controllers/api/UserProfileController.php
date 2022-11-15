<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\UserProfileInterface;

class UserProfileController extends Controller
{
    public $user_repository;
    public function __construct(UserProfileInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function all_users()
    {
        $response = $this->user_repository->all_users();
        if ($response != null) {
            return response()->json(['user' => $response], 200);
        } else {
            return response()->json(['error' => 'User not found.'], 401);
        }
    }
    public function user_info()
    {
        $response =$this->user_repository->user_info();
        return response()->json(['user' => $response], 200);
    }
}
