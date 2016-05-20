<?php

use Norm\Schema\NString;
use Norm\Schema\NPassword;

return [
    'fields' => [
        [ NString::class, [
            'name' => 'username',
            'filter' => 'trim|required|unique',
        ]],
        [ NPassword::class, [
            'name' => 'password',
            'filter' => 'trim|required|confirmed|salt',
        ]],
    ]
];