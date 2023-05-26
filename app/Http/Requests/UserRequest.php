<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user)],
            'password' => ['confirmed', Password::min(6)->letters()->numbers()],
            'active' => ['boolean'],
            'expired_at' => ['date_format:Y-m-d H:i:s']
        ];

        if (!$this->user) {
            $rules['email'][] = 'required';
            $rules['password'][] = 'required';
        }

        return $rules;
    }
}
