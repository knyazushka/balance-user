<?php

namespace App\Http\Controllers\Api;

use App\Contracts\OperationRepositoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use JustSteveKing\Tools\Http\Enums\Status;

final class OperationLatestController extends Controller
{
    public function __construct(
        private readonly OperationRepositoryContract $operationRepository
    ){}

    public function __invoke(): JsonResponse
    {
        $operations = $this->operationRepository->latest(
            userId: auth()->id(),
        );

        return response()->json(
            data: $operations,
            status: Status::OK->value,
        );
    }
}
