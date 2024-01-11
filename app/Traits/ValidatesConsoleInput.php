<?php

namespace App\Traits;

use Illuminate\Console\Concerns\HasParameters;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidatesConsoleInput
{
    use HasParameters;
    use InteractsWithIO;

    /**
     * @throws ValidationException
     */
    public function validate(array $argumentRules = null, $optionRules = null): array
    {
        $arguments = $argumentRules
            ? $this->validateArguments($this->arguments(), $argumentRules)
            : $this->arguments();

        $options = $optionRules
            ? $this->validateOptions($this->options(), $optionRules)
            : $this->options();

        return [$arguments, $options];
    }

    /**
     * @throws ValidationException
     */
    protected function validateOptions(array $options = [], array $rules = []): ?array
    {
        $validator = Validator::make($options, $rules);

        if ($validator->fails()) {
            $this->error('Input options is not valid');

            collect($validator->errors()->all())
                ->each(fn($error) => $this->line($error));
            exit();
        }

        return $validator->validated();
    }

    /**
     * @throws ValidationException
     */
    protected function validateArguments(array $arguments = [], array $rules = []): ?array
    {
        $validator = Validator::make($arguments, $rules);

        if ($validator->fails()) {
            $this->error('Input attributes is not valid');

            collect($validator->errors()->all())
                ->each(fn($error) => $this->line($error));
            exit();
        }

        return $validator->validated();
    }
}
