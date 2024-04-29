<?php

declare(strict_types=1);

namespace App\Http\Requests\Groups;

use App\Http\Payloads\Groups\NewGroup;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class StoreRequest extends FormRequest
{
    /** @return array<string, ValidationRule|array|string> */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['nullable', 'string', 'min:2', 'max:255'],
            'icon' => ['nullable', 'string', 'min:2', 'max:255'],
        ];
    }

    public function payload(): NewGroup
    {
        return new NewGroup(
            name: $this->string('name')->toString(),
            description: $this->has('description') ? $this->string('description')->toString() : null,
            icon: $this->has('icon') ? $this->string('icon')->toString() : null,
            user: (string) Auth::id(),
        );
    }
}
