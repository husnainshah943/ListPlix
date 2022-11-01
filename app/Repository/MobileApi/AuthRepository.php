<?php
namespace App\Repository\MobileApi;

use App\Models\User;
use App\Repository\MobileApi\IAuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthRepository implements IAuthRepository
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
            if ($user->verify_code != 'ok') {
                return 'Email is not verified';
            } else {
                if (auth()->attempt($data)) {
                    $token = auth()->user()->createToken('ListPlix')->accessToken;
                    return $token;
                } else {
                    return 'Password is incorrect.';
                }
            }
        } else {
            return 'Email is not registered';
        }
    }

    public function register(array $attributes)
    {
        $email = data_get($attributes, 'email');
        $code = $this->send_mail(['email' => $email]);
        $user = User::create([
            'name' => data_get($attributes, 'name'),
            'email' => data_get($attributes, 'email'),
            'password' => Hash::make(data_get($attributes, 'password')),
            'role' => data_get($attributes, 'role'),
            'department' => data_get($attributes, 'department'),
            'verify_code' => $code,
        ]);
        $token = $user->createToken('ListPlix')->accessToken;
        return [$token, $code];
    }

    public function send_mail($attributes)
    {
        $verify_code = mt_rand(1000, 9999);
        $send_mail_details['verify_code'] = $verify_code;
        $send_mail_details['to'] = data_get($attributes, 'email');
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
    public function verify_mail(array $attributes)
    {
        $user = User::where('email', data_get($attributes, 'email'))->get();

        if (count($user) > 0) {
            $user = User::find($user[0]['id']);
            $db_code = $user->verify_code;
            if ($db_code == data_get($attributes, 'verify_code')) {
                $user->verify_code = "ok";
                $user->email_verified_at = now()->toDateTimeString();
                $user->save();
                return true;
            } else {
                return false;
            }
        }
    }
    public function forget_password(array $attributes)
    {
        $user = User::where('email', data_get($attributes, 'email'))->get();
        if (count($user) > 0) {
            $verify_code = mt_rand(1000, 9999);
            $send_mail_details['verify_code'] = $verify_code;
            $send_mail_details['to'] = data_get($attributes, 'email');
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
    public function update_password(array $attributes)
    {
        $user = User::where('email', data_get($attributes, 'email'))->get();
        if (count($user) > 0) {
            $user = User::find($user[0]['id']);
            $user->password = Hash::make(data_get($attributes, 'password'));
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