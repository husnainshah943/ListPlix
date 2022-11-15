<?php
namespace App\Repository\Interfaces;

interface AuthInterface
{
    public function login($attributes);
    public function register($attributes);
    public function send_mail($attributes);
    public function verify_mail($attributes);
    public function forget_password($attributes);
    public function update_password($attributes);
    public function logout();
}
