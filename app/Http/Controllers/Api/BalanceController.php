<?php

namespace App\Http\Controllers\Api;

use App\Contracts\BalanceRepositoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use JustSteveKing\Tools\Http\Enums\Status;

final class BalanceController extends Controller
{
    public function __construct(
        private readonly BalanceRepositoryContract $balanceRepository,
    ){}

    public function __invoke(): JsonResponse
    {
        $balance = $this->balanceRepository->byUserId(
            userId: auth()->id(),
        );

        return response()->json(
            data: [
                'balance' => $balance
            ],
            status: Status::OK->value,
            headers: [
                'Content-Type' => 'application/json'
            ]
        );
    }
}
