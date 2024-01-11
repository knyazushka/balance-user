<?php

namespace App\Repositories;

use App\Contracts\BalanceRepositoryContract;
use App\Models\Balance;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BalanceRepository implements BalanceRepositoryContract
{
    public function byUserId(int $userId): Model|Builder
    {
        return Balance::query()
            ->where('user_id', $userId)->first();
    }
}
