<?php

namespace App\Rules;

use App\Helper\EventHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EventsLimit implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (EventHelper::qtyEventsIsExceeded()) {
            $fail(__('event.limit_exceed'));
        }
    }
}
