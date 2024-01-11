<?php

namespace App\Http\Payloads;

final readonly class LoginPayload
{
    public function __construct(
        private string $email,
        private string $password,
    ){}

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
