<?php

declare(strict_types=1);

use App\Models\User;
use App\Support\Facades\Auth;

use function Pest\Laravel\actingAs;

it('returns current user', function () {
    // Arrange
    $user = User::factory()->create();

    // Act & Assert
    actingAs($user);

    expect(Auth::userOrFail())->toBeInstanceOf(User::class);
});

it('fails when user is not authenticated', function () {
    // Act & Assert
    expect(Auth::userOrFail());
})->throws(RuntimeException::class, 'Cannot get the currently authenticated user.');
