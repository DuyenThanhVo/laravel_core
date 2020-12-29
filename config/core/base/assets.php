<?php

return [
    'offline' => env('ASSETS_OFFLINE', true),
    'enable_version' => env('ASSETS_ENABLE_VERSION', false),
    'version' => env('ASSETS_VERSION', time()),
    'styles' => [
        'plugins',
        'prismjs',
        'style',
        'base-dark',
        'menu-dark',
        'brand-dark',
        'aside-dark'
    ],
    'scripts' => [
        'plugins',
        'prismjs',
        'scripts'
    ],
    'resources' => [
        'styles' => [
            'plugins' => [
                'use_cdn' => false,
                'location' => 'header',
                'src' => [
                    'local' => '/vendor/core/plugins/global/plugins.bundle.css',
                ]
            ],
            'prismjs' => [
                'use_cdn' => false,
                'location' => 'header',
                'src' => [
                    'local' => '/vendor/core/plugins/custom/prismjs/prismjs.bundle.css',
                ]
            ],
            'style' => [
                'use_cdn' => false,
                'location' => 'header',
                'src' => [
                    'local' => '/vendor/core/css/style.bundle.css'
                ]
            ],
            'base-dark' => [
                'use_cdn' => false,
                'location' => 'header',
                'src' => [
                    'local' => '/vendor/core/css/themes/layout/header/base/dark.css'
                ]
            ],
            'menu-dark' => [
                'use_cdn' => false,
                'location' => 'header',
                'src' => [
                    'local' => '/vendor/core/css/themes/layout/header/menu/dark.css'
                ]
            ],
            'brand-dark' => [
                'use_cdn' => false,
                'location' => 'header',
                'src' => [
                    'local' => '/vendor/core/css/themes/layout/brand/dark.css'
                ]
            ],
            'aside-dark' => [
                'use_cdn' => false,
                'location' => 'header',
                'src' => [
                    'local' => '/vendor/core/css/themes/layout/aside/dark.css'
                ]
            ]
        ],
        'scripts' => [
            'plugins' => [
                'use_cdn' => false,
                'location' => 'footer',
                'src' => [
                    'local' => '/vendor/core/plugins/global/plugins.bundle.js',
                ]
            ],
            'prismjs' => [
                'use_cdn' => false,
                'location' => 'footer',
                'src' => [
                    'local' => '/vendor/core/plugins/custom/prismjs/prismjs.bundle.js',
                ]
            ],
            'scripts' => [
                'use_cdn' => false,
                'location' => 'footer',
                'src' => [
                    'local' => '/vendor/core/js/scripts.bundle.js'
                ]
            ]
        ]
    ],
];
