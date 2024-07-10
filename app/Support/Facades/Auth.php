<?php

declare(strict_types=1);

namespace App\Support\Facades;

use App\Models\User;
use Illuminate\Support\Facades\Auth as BaseAuth;
use RuntimeException;

class Auth extends BaseAuth
{
    public static function userOrFail(): User
    {
        $user = BaseAuth::user();

        if (! $user instanceof User) {
            throw new RuntimeException('Cannot get the currently authenticated user.');
        }

        return $user;
    }
}
