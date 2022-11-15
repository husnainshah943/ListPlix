<?php
namespace App\Repository;

use App\Models\User;
use App\Repository\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthRepository implements AuthInterface
{
<<<<<<< HEAD
    //Login For Mobile
    public function login(array $attributes)
    {

        $data = [
            'email' => data_get($attributes, 'email'),
            'password' => data_get($attributes, 'password'),
        ];

        $user = User::where('email', data_get($attributes, 'email'))->get();
=======
    public function login($attributes)
    {
        $data = [
            'email' => $attributes['email'],
            'password' => $attributes['password'],
        ];
        $user = User::where('email',$attributes['email'])->get();
>>>>>>> e8082a1 (ListPlix Completed - RestApis)

        if (count($user) > 0) {
            $user = User::find($user[0]['id']);
            if ($user->verify_code != 'ok') {
<<<<<<< HEAD
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
    //Login for Web
    public function web_login(array $attributes)
    {

        $data = [
            'email' => data_get($attributes, 'email'),
            'password' => data_get($attributes, 'password'),
        ];

        $user = User::where('email', data_get($attributes, 'email'))->get();

        if (data_get($attributes, 'email') == 'admin@gmail.com') {
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
        } else {
            return 'Email is incorrect';
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
=======
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
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
    }

    public function send_mail($attributes)
    {
        $verify_code = mt_rand(1000, 9999);
        $send_mail_details['verify_code'] = $verify_code;
<<<<<<< HEAD
        $send_mail_details['to'] = data_get($attributes, 'email');
=======
        $send_mail_details['to'] = $attributes['email'];
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
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
<<<<<<< HEAD
    public function verify_mail(array $attributes)
    {
        $user = User::where('email', data_get($attributes, 'email'))->get();
=======
    public function verify_mail($attributes)
    {
        $user = User::where('email', $attributes['email'])->get();
>>>>>>> e8082a1 (ListPlix Completed - RestApis)

        if (count($user) > 0) {
            $user = User::find($user[0]['id']);
            $db_code = $user->verify_code;
<<<<<<< HEAD
            if ($db_code == data_get($attributes, 'verify_code')) {
=======
            if ($db_code == $attributes['verify_code']) {
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
                $user->verify_code = "ok";
                $user->email_verified_at = now()->toDateTimeString();
                $user->save();
                return true;
            } else {
                return false;
            }
        }
    }
<<<<<<< HEAD
    public function forget_password(array $attributes)
    {
        $user = User::where('email', data_get($attributes, 'email'))->get();
        if (count($user) > 0) {
            $verify_code = mt_rand(1000, 9999);
            $send_mail_details['verify_code'] = $verify_code;
            $send_mail_details['to'] = data_get($attributes, 'email');
=======
    public function forget_password($attributes)
    {
        $user = User::where('email', $attributes['email'])->get();
        if (count($user) > 0) {
            $verify_code = mt_rand(1000, 9999);
            $send_mail_details['verify_code'] = $verify_code;
            $send_mail_details['to'] = $attributes['email'];
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
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
<<<<<<< HEAD
    public function update_password(array $attributes)
    {
        $user = User::where('email', data_get($attributes, 'email'))->get();
        if (count($user) > 0) {
            $user = User::find($user[0]['id']);
            $user->password = Hash::make(data_get($attributes, 'password'));
=======
    public function update_password($attributes)
    {
        $user = User::where('email', $attributes['email'])->get();
        if (count($user) > 0) {
            $user = User::find($user[0]['id']);
            $user->password = Hash::make($attributes['password']);
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
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
