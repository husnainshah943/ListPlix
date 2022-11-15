<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Http\Requests\AuthRequests\SendMailForgetRequest;
use App\Http\Requests\AuthRequests\UpdatePasswordRequest;
use App\Http\Requests\AuthRequests\VerifyMailRequest;
use App\Repository\Interfaces\AuthInterface;

class AuthController extends Controller
{

    public $auth_repository;
    public function __construct(AuthInterface $auth_repository)
    {
        $this->auth_repository = $auth_repository;
    }

    public function login(LoginRequest $request)
    {
        $response = $this->auth_repository->login($request->all());
        if (!empty($response['error'])) {
            return response()->json(['error' => $response['error']], 401);
        }else{
            return response()->json(['token' => $response], 200);
        }
    }

    public function register(RegisterRequest $request)
    {
        $response = $this->auth_repository->register($request->all());
        return response()->json(['code' => $response], 200);
    }
    public function send_mail(SendMailForgetRequest $request)
    {
        $response = $this->auth_repository->send_mail($request->all());
        return $response;
    }

    public function forget_password(SendMailForgetRequest $request)
    {
        $response = $this->auth_repository->forget_password($request->all());
        if (!$response) {
            return response()->json(['error' => 'Email is not registered.'], 401);
        } else {
            return response()->json(['code' => $response], 200);
        }
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        $response = $this->auth_repository->update_password($request->all());
        if ($response) {
            return response()->json(['message' => 'Password Updated'], 200);
        } else {
            return response()->json(['error' => 'User not found.'], 401);
        }

    }

    public function verify_mail(VerifyMailRequest $request)
    {
        $response = $this->auth_repository->verify_mail($request->all());

        if ($response) {
            return response()->json(['message' => 'ok'], 200);
        } else {
            return response()->json(['error' => 'failed'], 401);
        }

    }
    public function logout()
    {
        $response = $this->auth_repository->logout();
        if ($response) {
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
