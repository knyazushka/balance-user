<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryContract;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryContract
{
    public function create(array $attributes): User
    {
        return DB::transaction(
            callback: function () use ($attributes) {

                $user = User::query()->create(
                    attributes: $attributes
                );

                $user->balance()->create();

                return $user;
            }
        );
    }
}
