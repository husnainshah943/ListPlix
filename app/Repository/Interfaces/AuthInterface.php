<?php
namespace App\Repository\Interfaces;

interface AuthInterface
{
<<<<<<< HEAD
    public function login(array $attributes);
    public function web_login(array $attributes);
    public function register(array $attributes);
    public function send_mail(array $attributes);
    public function verify_mail(array $attributes);
    public function forget_password(array $attributes);
    public function update_password(array $attributes);
=======
    public function login($attributes);
    public function register($attributes);
    public function send_mail($attributes);
    public function verify_mail($attributes);
    public function forget_password($attributes);
    public function update_password($attributes);
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
    public function logout();
}
