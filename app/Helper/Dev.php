<?php

namespace App\Helper;

use App\Enums\Gender;
use Illuminate\Support\Str;

class Dev
{
    public function getFakeFullname(Gender $gender = null): string
    {
        return fake()->firstName($gender) . ' ' . fake()->lastName();
    }

    public function getFakeEmail(string $name = null): string
    {
        if (!empty($name)) {
            return Str::slug($name) . '@' . fake()->safeEmailDomain();
        }

        return fake()->unique()->safeEmail();
    }
}
