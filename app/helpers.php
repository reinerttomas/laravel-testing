<?php

declare(strict_types=1);

use App\Models\User;

if (! function_exists('current_user')) {
    function current_user(?string $guard = null): User
    {
        $user = auth($guard)->user();

        if (! $user instanceof User) {
            throw new RuntimeException('Cannot get the currently authenticated user.');
        }

        return $user;
    }
}
