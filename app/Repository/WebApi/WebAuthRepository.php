<?php
namespace App\Repository\WebApi;

use App\Models\User;
use App\Repository\WebApi\IWebAuthRepository;
use Illuminate\Support\Facades\Auth;

class WebAuthRepository implements IWebAuthRepository
{

    public function login(array $attributes)
    {

        $data = [
            'email' => data_get($attributes, 'email'),
            'password' => data_get($attributes, 'password'),
        ];

        $user = User::where('email', data_get($attributes, 'email'))->get();

        if (count($user) > 0) {
            $user = User::find($user[0]['id']);
            if (auth()->attempt($data)) {
                $token = auth()->user()->createToken('ListPlix')->accessToken;
                return $token;
            } else {
                return 'Password is incorrect.';
            }
        } else {
            return 'Email is not registered';
        }
    }

}