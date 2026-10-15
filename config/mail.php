<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    */

    'default' => env('MAIL_MAILER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    */

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'timeout' => null,
            'verify_peer' => false,
            'local_domain' => env(
                'MAIL_EHLO_DOMAIN',
                parse_url(
                    (string) env('APP_URL', 'http://localhost'),
                    PHP_URL_HOST
                )
            ),
            'stream' => [
                'ssl' => [
                    'allow_self_signed' => true,
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ],
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
        ],

        'resend' => [
            'transport' => 'resend',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env(
                'MAIL_SENDMAIL_PATH',
                '/usr/sbin/sendmail -bs -i'
            ),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
            'retry_after' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Global From Address
    |--------------------------------------------------------------------------
    */

    'from' => [
        'address' => env(
            'MAIL_FROM_ADDRESS',
            'josselinefariasgallardo@gmail.com'
        ),
        'name' => env(
            'MAIL_FROM_NAME',
            'Josseline Farias - Portafolio'
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact Recipient
    |--------------------------------------------------------------------------
    */

    'contact_to' => env(
        'MAIL_CONTACT_TO',
        'josselinefariasgallardo@gmail.com'
    ),

];
