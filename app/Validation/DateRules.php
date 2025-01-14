<?php

namespace App\Validation;

class DateRules
{
    public function less_than_date(string $str, string $fields, array $data): bool
    {
        return strtotime($str) < strtotime($data[$fields]);
    }

    public function greater_than_date(string $str, string $fields, array $data): bool
    {
        return strtotime($str) > strtotime($data[$fields]);
    }
}
