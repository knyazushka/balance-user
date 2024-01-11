<?php

namespace App\Http\Requests;

use App\Http\Payloads\LoginPayload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

final class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        if (!Auth::attempt($this->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => 'Email or password not valid',
            ]);
        }
    }

    public function payload(): LoginPayload
    {
        return new LoginPayload(
            email: $this->string('email')->toString(),
            password: $this->string('password')->toString(),
        );
    }
}
