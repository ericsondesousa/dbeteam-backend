<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'events_limit' => ['integer', 'min:1'],
            'players_limit' => ['integer', 'min:1'],
        ];

        if (!$this->plan) {
            $rules['events_limit'][] = 'required';
            $rules['players_limit'][] = 'required';
        }

        return $rules;
    }
}
