<?php

return array(

    'mode' => 'small', // small | panel | window

    'modes'    => [
        'small' => [
            'display'   => 'small',
            'fields'    => implode(',', [
                'email',
                'first_name',
                'last_name',
                'nickname',
                'photo',
                'photo_big',
                'bdate',
                'sex',
                'country',
                'city'
            ]),
            'providers' => implode(',', [
                'vkontakte',
                'odnoklassniki',
                'mailru',
                'facebook'
            ]),
            'hidden' => implode(',', [
                'other'
            ]),
            'redirect_uri' => route('laravel-ulogin'),
        ],
        'panel' => [
            'display'   => 'panel',
            'fields'    => implode(',', [
                'email',
                'first_name',
                'last_name',
                'nickname',
                'photo',
                'photo_big',
                'bdate',
                'sex',
                'country',
                'city'
            ]),
            'providers' => implode(',', [
                'vkontakte',
                'odnoklassniki',
                'mailru',
                'facebook'
            ]),
            'hidden' => implode(',', [
                'other'
            ]),
            'redirect_uri' => route('laravel-ulogin'),
        ],
        'window'=> [
            'display'   => 'window',
            'fields'    => implode(',', [
                'email',
                'first_name',
                'last_name',
                'nickname',
                'photo',
                'photo_big',
                'bdate',
                'sex',
                'country',
                'city'
            ]),
            'element'   => '<img src="https://ulogin.ru/img/button.png" width=187 height=30 alt="МультиВход"/>',
            'redirect_uri' => route('laravel-ulogin'),
        ],
    ],

    'template'  => 'default',

    'out'       => 'content',

    'redirect'  => route('laravel-ulogin'),

    'views'     => [
        'login'    => 'laravel-ulogin::ulogin-login',
        'error'     => 'laravel-ulogin::ulogin-error',
        'logged'     => 'laravel-ulogin::ulogin-logged',
    ],

    'add_to_groups' => [

    ],

);