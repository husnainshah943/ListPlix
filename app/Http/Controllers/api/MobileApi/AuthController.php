<?php

namespace App\Http\Controllers\api\MobileApi;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\MobileApi\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public $auth;
    public function __construct(AuthRepository $auth)
    {
        $this->auth = $auth;
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
        $login = $this->auth->login($request->only([
            'email',
            'password',
        ]));
        if ($login == 'Email is not verified') {
            return response()->json(['error' => 'Email is not verified'], 401);
        } else if ($login == 'Password is incorrect.') {
            return response()->json(['error' => 'Password is incorrect.'], 401);
        } else if ($login == 'Email is not registered') {
            return response()->json(['error' => 'Email is not registered'], 401);
        } else {
            return response()->json(['token' => $login], 200);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:8|max:16',
            'role' => 'required',
            'department' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $register = $this->auth->register($request->only([
            'name',
            'email',
            'password',
            'role',
            'department',
        ]));
        list($token, $code) = $register;
        return response()->json(['token' => $token, 'code' => $code], 200);
    }
    public function send_mail(Request $request)
    {
        $send_email = $this->auth->send_mail($request->only([
            'email',
        ]));
        return $send_email;
    }

    public function forget_password(Request $request)
    {
        $forget_pass = $this->auth->send_mail($request->only([
            'email',
        ]));
        if (!true) {
            return response()->json(['error' => 'Email is not registered.'], 401);
        } else {
            return response()->json(['code' => $forget_pass], 200);
        }

    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
            'password' => 'required|min:8|max:16',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $update_pass = $this->auth->send_mail($request->only([
            'email',
            'password',
        ]));
        if ($update_pass) {
            return response()->json(['message' => 'Password Updated'], 200);
        } else {
            return response()->json(['error' => 'User not found.'], 200);
        }

    }

    public function verify_mail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
            'verify_code' => 'required|max:4',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $verify_mail = $this->auth->verify_mail($request->only([
            'email',
            'verify_code',
        ]));

        if ($verify_mail) {
            return response()->json(['message' => 'ok'], 200);
        } else {
            return response()->json(['error' => 'failed'], 401);
        }

    }
    public function logout(Request $request)
    {
        $logout = $this->auth->logout($request->only([
        ]));
        if ($logout) {
            return response()->json([
                'message' => 'Successfully logged out',
            ]);
        } else {
            return response()->json([
                'error' => 'logout failed',
            ]);
        }

    }

    public function user_info()
    {
        $user = auth()->user();
        return response()->json(['user' => $user], 200);
    }
}