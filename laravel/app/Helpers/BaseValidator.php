<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BaseValidator
{
    /**
     * Валидация входящих данных по заданным правилам.
     *
     * @param array $data Данные, которые нужно проверить.
     * @param array $rules Правила валидации.
     * @throws ValidationException Если валидация не прошла.
     */
    public function validate(array $data, array $rules): void
    {
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
