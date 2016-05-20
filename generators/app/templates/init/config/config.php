<?php

use T\Renderer as TRenderer;

return [
    // you can define monolog logger here to use logging facility
    'loggers' => [

    ],
    'middlewares' => [
        [ Bono\Middleware\TemplateRenderer::class, [
            'options' => [
                'renderer' => [ TRenderer::class, ],
            ],
        ]],
        [ Bono\Middleware\ContentNegotiator::class, ],
        [ Bono\Middleware\BodyParser::class, ],
        [ Bono\Middleware\MethodOverride::class, ],
        [ Bono\Middleware\Session::class, ],
        [ Bono\Middleware\Notification::class, ],
        [ Xinix\BonoAuth\Middleware\Auth::class, [
            'authenticators' => [
                [ Xinix\BonoAuth\Authenticator\Norm::class ]
            ],
            'rules' => [
                // [ 'allow', '/' ],
                [ 'allow', '/auth/user/**', '*' ]
            ],
        ]],
        [ Bono\Middleware\StaticPage::class, ],
        [ ROH\BonoNorm\Middleware\Norm::class, [
            // Connections
            'connections' => [
                [ Norm\Adapter\File::class, [
                    'id' => 'fdb',
                    'options' => [
                        'dataDir' => '../data',
                    ]
                ]]
            ],

            // Attributes
            'attributes' => [
                'salt' => ['md5', 'replace this salt key'],
            ],

            // Default collection descriptor
            'default' => [
                // The observer, more like a hook event
                'observers' => [
                    [ Norm\Observer\Actorable::class, ],
                    [ Norm\Observer\Timestampable::class, ],
                ],
                // Limit the entries that shown, then paginate them
                'limit' => 20,
            ],

            // Resolver to find where the schemas config stored see in /config/collections folder
            'resolvers' => [
                [ Norm\Resolver\DefaultResolver::class, ],
            ],
        ]],
    ],
    // bundle examples
    'bundles' => [
        [
            'uri' => '/foo',
            'handler' => [ ROH\BonoNorm\Bundle\Norm::class ],
        ],
        [
            'uri' => '/bar',
            'handler' => [ ROH\BonoNorm\Bundle\Norm::class ],
        ],
        // this bundle needed as auth user bundle
        [
            'uri' => '/auth/user',
            'handler' => [ ROH\BonoNorm\Bundle\Norm::class ],
        ],
    ],
    // route examples
    // 'routes' => [
    //     [
    //         'uri' => '/',
    //         'handler' => function ($context) {
    //             return [
    //                 'ok' => true
    //             ];
    //         }
    //     ]
    // ]
];