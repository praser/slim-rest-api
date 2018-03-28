<?php

use Psr7Middlewares\Middleware\TrailingSlash;

/**
 * @Middleware tratamento da / no final da rota das requests
 * true adiciona a / no final da rota da request
 * false remove a / do final da rota da request
 */
$app->add(new TrailingSlash(false));