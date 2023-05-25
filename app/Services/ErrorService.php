<?php

namespace App\Services;

class ErrorService
{
    public function generateError(string|array $errors): array
    {
        if (!is_array($errors)) {
            $errors = [$errors];
        }

        return [
            'errors' => $errors,
        ];
    }
}
