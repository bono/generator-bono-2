<?php

use Norm\Schema\NString;

return [
    'fields' => [
        [ NString::class, [
            'name' => 'name',
            'filter' => 'trim|required',
        ]],
    ],
];