<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/modules' => [
            [['_route' => 'api_modules', '_controller' => 'App\\Controller\\Api\\ModuleApiController::index'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'api_module_create', '_controller' => 'App\\Controller\\Api\\ModuleApiController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/' => [[['_route' => 'app_module_list', '_controller' => 'App\\Controller\\ModuleController::index'], null, null, null, false, false, null]],
        '/create' => [[['_route' => 'app_module_create', '_controller' => 'App\\Controller\\ModuleController::create'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/modules/(\\d+)(?'
                    .'|(*:63)'
                .')'
                .'|/(\\d+)(*:77)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        63 => [
            [['_route' => 'api_module_show', '_controller' => 'App\\Controller\\Api\\ModuleApiController::show'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api-module_delete', '_controller' => 'App\\Controller\\Api\\ModuleApiController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        77 => [
            [['_route' => 'app_module_show', '_controller' => 'App\\Controller\\ModuleController::show'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
