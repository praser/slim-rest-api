<?php

/**
 * Use este arquivo para definir cofigurações do projeto e suas dependências.
 */

return [
  'settings' => [
    'displayErrorDetails' => true, // Mostrar detalhes dos erros, settar para false em PRD
    'addContentLengthHeader' => true, // Habilita o servidor para neviar o cabeçalho content-length

    //Configurações do Monolog
    'logger' => [
      'name' => 'slim-app',
      'path' => __DIR__ . '/../logs/app.log',
      'level' => \Monolog\Logger::DEBUG
    ]
  ]
];