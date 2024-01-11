<?php

namespace App\Console\Commands;

use App\Contracts\OperationRepositoryContract;
use App\Contracts\UserRepositoryContract;
use App\Enums\OperationType;
use App\Traits\ValidatesConsoleInput;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ChangeBalanceCommand extends Command
{
    use ValidatesConsoleInput;

    protected $signature = 'app:change-balance {name : User name} {--operation= : Type operation} {--description= Description} {--sum= Operation sum}';

    protected $description = 'Change balance by user name';

    /**
     * @throws ValidationException
     */
    public function handle(UserRepositoryContract $userRepository, OperationRepositoryContract $operationRepository): void
    {
        [$arguments, $options] = $this->validate(
            argumentRules: [
                'name' => ['required', 'string', 'exists:users,name']
            ],
            optionRules: [
                'operation' => ['required', Rule::enum(OperationType::class)],
                'description' => ['required'],
                'sum' => ['required', 'int']
            ],
        );

        $user = $userRepository->byName(name: $arguments['name']);

        if ($options['operation'] === OperationType::OPERATION_IN->value) {
            $operationRepository->create(attributes: [
                'type' => 'in',
                'description' => $options['description'],
                'sum' => $options['sum'],
                'user_id' => $user->id,
            ]);

            $user->balance()->increment('balance', (int)$options['sum']);
            $this->info('Operation created');
        } elseif ($options['operation'] === OperationType::OPERATION_OUT->value && $user->balance->balance > (int)$options['sum']) {
            $operationRepository->create(attributes: [
                'type' => 'out',
                'description' => $options['description'],
                'sum' => $options['sum'],
                'user_id' => $user->id,
            ]);

            $user->balance()->decrement('balance', (int)$options['sum']);
            $this->info('Operation created');
        } else {
            $this->info('Failed');
        }
    }
}
