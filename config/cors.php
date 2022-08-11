<?php

$origin = 'grape.chasoslov.info';
return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

//    'allowed_methods' => ['*'],
//
//    'allowed_origins' => ['*'],
//
//    'allowed_origins_patterns' => [],
//
//    'allowed_headers' => ['*'],
//
//    'exposed_headers' => [],

    'allowedOrigins' => [$origin, 'http://127.0.0.1:8000'],
    'allowedHeaders' => ['Content-Type', 'Accept', 'Authorization', 'X-Requested-With', 'Application'],
    'allowedMethods' => ['POST', 'GET', 'OPTIONS', 'PUT', 'DELETE'],
    'exposedHeaders' => ['Authorization'],

    'max_age' => 0,

    'supports_credentials' => true,

];
