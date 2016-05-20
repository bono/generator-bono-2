<?php

use Norm\Schema\NString;
use Norm\Schema\NBool;
use Norm\Schema\NDate;
use Norm\Schema\NDateTime;
use Norm\Schema\NFile;
use Norm\Schema\NFloat;
use Norm\Schema\NInteger;
use Norm\Schema\NList;
use Norm\Schema\NObject;
use Norm\Schema\NReference;
use Norm\Schema\NReferenceList;
use Norm\Schema\NText;
use Norm\Schema\NUnsafeString;
use Norm\Schema\NUnsafeText;
use Norm\Schema\NToken;

return [
    'fields' => [
        [ NString::class, [
            'name' => 'input_string',
            'filter' => 'trim|required',
        ]],
        [ NBool::class, [
            'name' => 'input_boolean',
            'filter' => 'required',
        ]],
        [ NDate::class, [
            'name' => 'input_date',
            'filter' => 'trim|required',
        ]],
        [ NDateTime::class, [
            'name' => 'input_datetime',
            'filter' => 'trim|required',
        ]],
        [ NFile::class, [
            'name' => 'input_file',
            'filter' => 'required',
            'dataDir' => 'files',
        ]],
        [ NFloat::class, [
            'name' => 'input_float',
            'filter' => 'trim|required',
        ]],
        [ NInteger::class, [
            'name' => 'input_integer',
            'filter' => 'trim|required',
        ]],
        [ NList::class, [
            'name' => 'input_list',
            'filter' => 'removeEmpty|required',
        ]],
        [ NObject::class, [
            'name' => 'input_object',
            'filter' => 'required',
        ]],
        [ NReference::class, [
            'name' => 'input_reference',
            'to' => 'Bar',
            'filter' => 'trim|required',
        ]],
        [ NReferenceList::class, [
            'name' => 'input_reference_list',
            'to' => 'Bar',
            'filter' => 'removeEmpty|required',
        ]],
        [ NText::class, [
            'name' => 'input_text',
            'filter' => 'trim|required',
        ]],
        [ NToken::class, [
            'name' => 'input_token',
            'filter' => 'trim|required',
        ]],
        [ NUnsafeString::class, [
            'name' => 'input_unsafe_string',
            'filter' => 'trim|required',
        ]],
        [ NUnsafeText::class, [
            'name' => 'input_unsafe_text',
            'filter' => 'trim|required',
        ]],
    ],
];