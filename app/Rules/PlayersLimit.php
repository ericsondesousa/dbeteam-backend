<?php

namespace App\Rules;

use App\Helper\PlayerHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PlayersLimit implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (PlayerHelper::qtyPlayersIsExceeded()) {
            $fail(__('player.limit_exceed'));
        }
    }
}
