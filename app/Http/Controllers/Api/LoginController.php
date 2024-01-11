<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Responses\MessageResponse;
use App\Services\IdentityService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Validation\ValidationException;

final readonly class LoginController
{
    public function __construct(
        private IdentityService $service,
    ) {}

    /**
     * @throws ValidationException
     */
    public function __invoke(LoginRequest $request): Responsable
    {
        if (!$this->service->login(payload: $request->payload())) {
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

        return new MessageResponse(
            data: $token->plainTextToken,
            key: 'token',
        );
    }
}
