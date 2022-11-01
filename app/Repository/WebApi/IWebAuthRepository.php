<?php
namespace App\Repository\WebApi;

interface IWebAuthRepository
{
    public function login(array $attributes);
    // public function register(array $attributes);
    // public function send_mail(array $attributes);
    // public function verify_mail(array $attributes);
    // public function forget_password(array $attributes);
    // public function update_password(array $attributes);
    // public function logout();
}