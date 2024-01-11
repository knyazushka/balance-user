<?php

namespace App\Contracts;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Collection;

interface OperationRepositoryContract
{
    public function create(array $attributes): Operation;

    public function latest(int $userId): Collection;

    public function list(int $userId, string $description = null, string $sort = 'desc'): Collection;
}
