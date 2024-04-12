<?php

namespace App\Http\Api\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    protected static array $optional_fields = [];

    protected array $defaultValues = [];

    abstract public function rules(): array;

    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated();

        foreach (static::$optional_fields as $field) {
            if (! isset($validated[$field])) {
                $validated[$field] = null;
            }
        }

        return $validated;
    }

    /**
     * Set default values if not filled
     */
    public function prepareForValidation(): void
    {
        foreach ($this->defaultValues as $key => $value) {
            if (! $this->has($key) || ! $this->filled($key)) {
                $this->merge([
                    $key => $value,
                ]);
            }
        }
    }
}
