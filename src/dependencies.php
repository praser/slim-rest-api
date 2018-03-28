<?php

use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Configurações do container de injeção de depências
$container = $app->getContainer();

//Error Handler
$container['errorHandler'] = function($c) {
  return function($req, $res, $exception){
    $statusCode = $exception->getCode() ? $exception->getCode() : 500;
    return $res->withJson(['message' => $exception->getMessage()], $statusCode);
  };
};

$container['notAllowedHandler'] = function($c) {
  return function($req, $res, $methods) {
    return $res->withHeader('Allow', implode(',', $methods))
               ->withHeader('Access-Control-Allow-Methods', implode(',', $methods))
               ->withJson(['message' => 'Method not allowed; Method must be one of: ' . implode(',', $methods)], 405);
  };
};

$container['notFoundHandler'] = function($c) {
  return function($req, $res) {
    return $res->withJson(['message' => 'Page not found'], 404);
  };
};

// Monolog
$container['logger'] = function ($c) {
  $settings = $c->get('settings')['logger'];
  $logger = new Logger($settings['name']);
  $logger->pushProcessor(new UidProcessor());
  $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));

  return $logger;
};

// Doctrine
$container['entityManager'] = function ($c) {
  $settings = $c->get('settings')['db'];
  $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/Models/Entity"), true);

  return EntityManager::create($settings, $config);
};

return $container;