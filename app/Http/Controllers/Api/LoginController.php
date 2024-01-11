<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\IdentityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use JustSteveKing\Tools\Http\Enums\Status;

final class LoginController extends Controller
{
    public function __construct(
        private readonly IdentityService $service,
    ) {}

    /**
     * @throws ValidationException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $this->validate($request, $request->rules());

        if (!$this->service->login(attributes: $request->validated())) {
            throw ValidationException::withMessages(
                messages: [
                    'email' => 'Invalid credentials.',
                ]
            );
        }

        $token = $this->service->createToken(
            user: $this->service->getAuthenticatedUser(),
            name: config('app.name'),
        );

        return response()->json(
            data: [
                'token' => $token->plainTextToken,
            ],
            status: Status::OK->value,
        );
    }
}
