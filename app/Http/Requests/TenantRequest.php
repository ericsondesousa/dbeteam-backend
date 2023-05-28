<?php

namespace App\Http\Requests;

use App\Models\Plan;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
            'plan_id' => ['required', 'integer', Rule::in(Plan::all()->pluck('id'))],
            'subscriber' => ['boolean']
        ];

        if ($this->tenant) {
            $rules['expired_at'][] = 'required';
        }

        return $rules;
    }
}
