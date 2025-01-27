<?php

namespace AbdelrhmanSaeed\Tpo\DTO;


class UserDTO extends DTO
{
    public static function rules(): array
    {
        return [
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'required',
            'phone'         => 'required',
        ];
    }
}