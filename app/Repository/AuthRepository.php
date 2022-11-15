<?php
namespace App\Repository;

use App\Models\User;
use App\Repository\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthRepository implements AuthInterface
{
    public function login($attributes)
    {
        $data = [
            'email' => $attributes['email'],
            'password' => $attributes['password'],
        ];
        $user = User::where('email',$attributes['email'])->get();

        if (count($user) > 0) {
            $user = User::find($user[0]['id']);
            if ($user->verify_code != 'ok') {
                $error = ['error' => 'Email is not verified'];
            } else {
                if (auth()->attempt($data)) {
                    $token = auth()->user()->createToken('ListPlix')->accessToken;
                    return 'Bearer '.$token;
                } else {
                    $error = ['error' => 'Password is incorrect'];
                }
            }
        } else {
            $error = ['error' => 'Email is not registered'];
        }
        return $error;
    }

    public function register($attributes)
    {
        $email = $attributes['email'];
        $code = $this->send_mail(['email' => $email]);
        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'role' => $attributes['role'],
            'department' => $attributes['department'],
            'verify_code' => $code,
        ]);
        return $code;
    }

    public function send_mail($attributes)
    {
        $verify_code = mt_rand(1000, 9999);
        $send_mail_details['verify_code'] = $verify_code;
        $send_mail_details['to'] = $attributes['email'];
        $send_mail_details['title'] = "Email Verification";
        $send_mail_details['body'] = "Please verify your email using this code: ";

        Mail::send('mail', ['send_mail_details' => $send_mail_details], function ($messages) use ($send_mail_details) {
            $messages->to($send_mail_details['to']);
            $messages->subject($send_mail_details['title']);

        });
        $user = User::where('email', $attributes)->get();

        if (count($user) > 0) {
            $user = User::find($user[0]['id']);
            $db_code = $user->verify_code;
            $user->verify_code = $verify_code;
            $user->save();
        }
        return $verify_code;
    }
    public function verify_mail($attributes)
    {
        $user = User::where('email', $attributes['email'])->get();

        if (count($user) > 0) {
            $user = User::find($user[0]['id']);
            $db_code = $user->verify_code;
            if ($db_code == $attributes['verify_code']) {
                $user->verify_code = "ok";
                $user->email_verified_at = now()->toDateTimeString();
                $user->save();
                return true;
            } else {
                return false;
            }
        }
    }
    public function forget_password($attributes)
    {
        $user = User::where('email', $attributes['email'])->get();
        if (count($user) > 0) {
            $verify_code = mt_rand(1000, 9999);
            $send_mail_details['verify_code'] = $verify_code;
            $send_mail_details['to'] = $attributes['email'];
            $send_mail_details['title'] = "Forget Password";
            $send_mail_details['body'] = "Please enter this code to change password. : ";

            Mail::send('mail', ['send_mail_details' => $send_mail_details], function ($messages) use ($send_mail_details) {
                $messages->to($send_mail_details['to']);
                $messages->subject($send_mail_details['title']);

            });
            return $verify_code;
        } else {
            return false;
        }
    }
    public function update_password($attributes)
    {
        $user = User::where('email', $attributes['email'])->get();
        if (count($user) > 0) {
            $user = User::find($user[0]['id']);
            $user->password = Hash::make($attributes['password']);
            $user->save();
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();
        return true;
    }
}
