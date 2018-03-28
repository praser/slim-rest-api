<?php

/**
 * Rotas da aplicação
 */

 use Slim\Http\Request;
 use Slim\Http\Response;

 $app->get('/{name}', function(Request $req, Response $res, array $args) {
  // Insere uma mensagem de exemplo no Log
  $this->logger->info("Rest API com Slim rota '/'");

  return $res->withJson(['name' => $args['name']], 200);
 });