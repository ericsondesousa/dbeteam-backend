<?php

namespace App\Helper;

use App\Enums\Gender;
use Illuminate\Support\Str;

class Dev
{
    public static function getFakeFullname(Gender $gender = null): string
    {
        return fake()->firstName($gender) . ' ' . fake()->lastName();
    }

    public static function getFakeEmail(string $name = null): string
    {
        if (!empty($name)) {
            return Str::slug($name) . '@' . fake()->safeEmailDomain();
        }

        return fake()->unique()->safeEmail();
    }

    public static function generateToken(): string
    {
        return hash('sha256', rand(0, 999999) . microtime() . rand(0, 999999));
    }
}
