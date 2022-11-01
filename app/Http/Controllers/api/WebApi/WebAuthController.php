<?php

namespace App\Http\Controllers\api\WebApi;

use App\Http\Controllers\Controller;
use App\Repository\WebApi\WebAuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebAuthController extends Controller
{
    public $authentication;
    public function __construct(WebAuthRepository $authentication)
    {
        $this->authentication = $authentication;
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if ($request->email == 'admin@gmail.com') {
            $login = $this->authentication->login($request->only([
                'email',
                'password',
            ]));
            if ($login == 'Password is incorrect.') {
                return response()->json(['error' => 'Password is incorrect.'], 401);
            } else if ($login == 'Email is not registered') {
                return response()->json(['error' => 'Email is not registered'], 401);
            } else {
                return response()->json(['token' => $login], 200);
            }
        } else {
            return response()->json(['error' => 'Please login using admin details'], 401);
        }
    }

}