<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'type' => ['required', Rule::in(['I', 'B'])],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
            'address' => ['required', 'string', 'min:5', 'max:255'],
            'city' => ['required', 'string', 'min:2', 'max:120'],
            'state' => ['required', 'string', 'min:2', 'max:100'],
            'postal_code' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[A-Za-z0-9\- ]+$/'],
        ];
    }

    /**
     * Normalize input before validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name', '')),
            'type' => trim((string) $this->input('type', '')),
            'email' => strtolower(trim((string) $this->input('email', ''))),
            'address' => trim((string) $this->input('address', '')),
            'city' => trim((string) $this->input('city', '')),
            'state' => trim((string) $this->input('state', '')),
            'postal_code' => trim((string) $this->input('postal_code', '')),
        ]);
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name cannot be empty.',
            'name.min' => 'Name must be at least :min characters.',
            'address.required' => 'Address cannot be empty.',
            'address.min' => 'Address must be at least :min characters.',
            'city.required' => 'City cannot be empty.',
            'city.min' => 'City must be at least :min characters.',
            'state.required' => 'State cannot be empty.',
            'state.min' => 'State must be at least :min characters.',
            'postal_code.required' => 'Postal code cannot be empty.',
            'postal_code.min' => 'Postal code must be at least :min characters.',
            'postal_code.regex' => 'Postal code may only contain letters, numbers, spaces, and hyphens.',
        ];
    }
}
