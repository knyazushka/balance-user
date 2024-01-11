<?php

namespace App\Http\Controllers\Api;

use App\Contracts\BalanceRepositoryContract;
use App\Http\Resources\BalanceResource;
use App\Http\Responses\ModelResponse;
use Illuminate\Contracts\Support\Responsable;

final readonly class BalanceController
{
    public function __construct(
        private BalanceRepositoryContract $balanceRepository,
    ){}

    public function __invoke(): Responsable
    {
        $balance = $this->balanceRepository->byUserId(
            userId: auth()->id(),
        );

        return new ModelResponse(
            data: new BalanceResource(
                resource: $balance,
            ),
            key: 'balance',
        );
    }
}
