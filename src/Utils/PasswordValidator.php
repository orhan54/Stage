<?php

namespace App\Utils;

class PasswordValidator
{
    public static function valider(string $password): bool
    {
        return preg_match('/^(?=.*[A-Z])(?=.*[\W_]).{12,}$/', $password) === 1;
    }
}
