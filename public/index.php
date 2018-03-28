<?php
require __DIR__ . '/../vendor/autoload.php';

// Instancia o aplicativo
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Configura as dependências
require __DIR__ . '/../src/dependencies.php';

// Registra os midlewares
require __DIR__ . '/../src/middleware.php';

// Registra as rotas
require __DIR__ . '/../src/routes.php';

// Executa o aplicativo
$app->run();