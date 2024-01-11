<?php

namespace App\Repositories;

use App\Contracts\OperationRepositoryContract;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class OperationRepository implements OperationRepositoryContract
{
    public function create(array $attributes): Operation
    {
        return DB::transaction(
            callback: function () use ($attributes) {
                return Operation::query()->create(
                    attributes: $attributes,
                );
            }
        );
    }

    public function latest(int $userId): Collection
    {
        return Operation::query()->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();
    }

    public function list(int $userId, string $description = null, string $sort = null): Collection
    {
        $operations = Operation::query()
            ->where('user_id', $userId);

        if (!empty($description)) {
            $operations->where('description', 'ilike', "%{$description}%");
        }

        if (!empty($sort)) {
            $operations->orderBy('created_at', $sort);
        }

        return $operations->get();
    }
}
