<?php
namespace App\Repository\Interfaces;

interface AuthInterface
{
    public function login(array $attributes);
    public function web_login(array $attributes);
    public function register(array $attributes);
    public function send_mail(array $attributes);
    public function verify_mail(array $attributes);
    public function forget_password(array $attributes);
    public function update_password(array $attributes);
    public function logout();
}
