<?php

namespace App\Http\Controllers\Api;

use App\Contracts\OperationRepositoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JustSteveKing\Tools\Http\Enums\Status;

final class OperationListController extends Controller
{
    public function __construct(
        private readonly OperationRepositoryContract $operationRepository
    ){}

    public function __invoke(Request $request): JsonResponse
    {
        $operations = $this->operationRepository->list(
            userId: auth()->id(),
            description: $request->description,
            sort: $request->sort,
        );

        return response()->json(
            data: $operations,
            status: Status::OK->value,
        );
    }
}
