<?php

namespace App\Services;

use App\Models\User;
use App\Traits\HasAuthAndDatabase;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\NewAccessToken;

final class IdentityService
{
    use HasAuthAndDatabase;

    public function login(array $attributes): bool
    {
        return $this->auth->attempt(
            credentials: $attributes,
        );
    }

    public function getAuthenticatedUser(): User|null|Authenticatable
    {
        return $this->auth->user();
    }

    public function createToken(Authenticatable|User $user, string $name, array $permissions = ['*']): NewAccessToken
    {
        return $user?->createToken(
            name: $name,
            abilities: $permissions,
        );
    }
}
