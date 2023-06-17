<?php

namespace App\Http\Requests;

use App\Models\Event;
use App\Rules\PlayersLimit;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
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
            'event_id' => ['integer', Rule::in(Event::all()->pluck('id'))],
            'name' => ['required', 'string', 'max:100'],
        ];

        if (!$this->player) {
            $rules['name'][] = new PlayersLimit;
            $rules['event_id'][] = 'required';
        }

        return $rules;
    }
}
