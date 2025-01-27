<?php

namespace AbdelrhmanSaeed\Tpo\DTO;

abstract class DTO
{
    private static array $validated = [];
    private static array $errors    = [];

    abstract static protected function rules(): array;

    public static function validate(array $data): bool
    {
        $rules = static::rules();

        foreach ($rules as $key => $rule) {
            if (isset($data[$key]) && ! empty($data[$key])) {
                self::$validated[$key] = $data[$key];
            } else {
                self::$errors[$key] = 'required';
                return false;
            }
        }

        return true;
    }

    public static function getValidated(): array
    {
        return self::$validated;
    }

    public static function getErrors(): array
    {
        return self::$errors;
    }
}