<?php

namespace App\Console\Commands;

use App\Contracts\UserRepositoryContract;
use App\Traits\ValidatesConsoleInput;
use Illuminate\Console\Command;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

final class UserCreateCommand extends Command
{
    use ValidatesConsoleInput;

    protected $signature = 'app:user-create {email : User email} {--name= : User name} {--password= : User password}';

    protected $help = "Usage:\n app:create-user example@domail.com --name=example --password=qwerty12";

    protected $description = 'Create new user';

    /**
     * @throws ValidationException
     */
    public function handle(UserRepositoryContract $userRepository): void
    {
        [$arguments, $options] = $this->validate(
            argumentRules: [
                'email' => ['required', 'email', 'unique:users,email']
            ],
            optionRules: [
                'name' => ['required', 'string', 'min:4', 'max:255'],
                'password' => Password::default(),
            ],
        );

        $userRepository->create(
            attributes: [
                'name' => $options['name'],
                'email' => $arguments['email'],
                'password' => $options['password'],
            ]
        );

        $this->info('User created');
    }
}
