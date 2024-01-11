<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryContract
{
    public function create(array $attributes): User;

    public function byName(string $name): Builder|Model;
}
