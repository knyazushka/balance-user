<?php

namespace App\Contracts;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface BalanceRepositoryContract
{
    public function byUserId(int $userId): Model|Builder;
}
