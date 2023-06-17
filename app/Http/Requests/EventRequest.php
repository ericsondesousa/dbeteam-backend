<?php

namespace App\Http\Requests;

use App\Models\Tenant;
use App\Rules\EventsLimit;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        $limit_players = auth()->user()->tenant->plan->players_limit ?? 10;
        $limit_queue = boolval($this->has_queue) ? intval($limit_players) - intval($this->qty_players) : 0;

        $rules = [
            'tenant_id' => ['integer', Rule::in(Tenant::all()->pluck('id'))],
            'name' => ['required', 'string', 'max:100'],
            'event_date' => ['required', 'date_format:' . config('dev.date_format.default_shortime'), 'after:now'],
            'confirmation_until' => ['required', 'date', 'before_or_equal:event_date', 'after:now'],
            'qty_players' => ['required', 'integer', 'min:1', "max:{$limit_players}"],
            'has_queue' => ['required', 'boolean'],
            'qty_players_queue' => ['required_if:has_queue,true', 'integer', "max:{$limit_queue}"],
            'closed' => ['boolean']
        ];

        if (!$this->event) {
            $rules['event_date'][] = new EventsLimit;
            $rules['tenant_id'][] = 'required';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'qty_players.max' => __('player.limit_exceed'),
            'qty_players_queue.max' => __('player.limit_exceed'),
        ];
    }
}
