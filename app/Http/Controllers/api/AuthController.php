<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequests;
use App\Http\Requests\RegisterRequests;
use App\Http\Requests\SendMail_ForgetRequests;
use App\Http\Requests\Update_PasswordRequests;
use App\Http\Requests\Verify_MailRequests;
use App\Repository\Interfaces\AuthInterface;

class AuthController extends Controller
{

    public $auth_repository;
    public function __construct(AuthInterface $auth_repository)
    {
        $this->auth_repository = $auth_repository;
    }
    //Login for Mobile
    public function login(LoginRequests $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        $login = $this->auth_repository->login($data);
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
    ///Login for Web
    public function web_login(LoginRequests $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        $login = $this->auth_repository->web_login($data);
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

    public function register(RegisterRequests $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
            'department' => $request->input('department'),
        ];
        $register = $this->auth_repository->register($data);
        list($token, $code) = $register;
        return response()->json(['token' => $token, 'message' => $code], 200);
    }
    public function send_mail(SendMail_ForgetRequests $request)
    {
        $data = [
            'email' => $request->input('email'),
        ];
        $send_email = $this->auth_repository->send_mail($data);
        return $send_email;
    }

    public function forget_password(SendMail_ForgetRequests $request)
    {
        $data = [
            'email' => $request->input('email'),
        ];
        $forget_pass = $this->auth_repository->forget_password($data);
        if (!true) {
            return response()->json(['error' => 'Email is not registered.'], 401);
        } else {
            return response()->json(['message' => $forget_pass], 200);
        }
    }

    public function update_password(Update_PasswordRequests $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        $update_pass = $this->auth_repository->update_password($data);
        if ($update_pass) {
            return response()->json(['message' => 'Password Updated'], 200);
        } else {
            return response()->json(['error' => 'User not found.'], 401);
        }

    }

    public function verify_mail(Verify_MailRequests $request)
    {
        $data = [
            'email' => $request->input('email'),
            'verify_code' => $request->input('verify_code'),
        ];

        $verify_mail = $this->auth_repository->verify_mail($data);

        if ($verify_mail) {
            return response()->json(['message' => 'ok'], 200);
        } else {
            return response()->json(['error' => 'failed'], 401);
        }

    }
    public function logout()
    {
        $logout = $this->auth_repository->logout();
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
}