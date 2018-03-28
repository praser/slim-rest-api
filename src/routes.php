<?php

/**
 * Rotas da aplicação
 */

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Entity\Book;

/*$app->get('/{name}', function(Request $req, Response $res, array $args) {
// Insere uma mensagem de exemplo no Log
$this->logger->info("Rest API com Slim rota '/'");

return $res->withJson(['name' => $args['name']], 200);
});*/


$app->post('/books', function (Request $req, Response $res) use ($app){
  $params = (object) $req->getParams();

  $book = new Book();
  $book->setName($params->name);
  $book->setAuthor($params->author);

  $em = $this->entityManager;
  $em->persist($book);
  $em->flush();

  $this->logger->info('Book Created!', $book->getValues());

  return $res->withJson($book, 201);
});

$app->get('/books', function(Request $req, Response $res) use($app){
  $booksRepository = $this->entityManager->getRepository('App\Models\Entity\Book');
  $books = $booksRepository->findAll();

  return $res->withJson($books);
});

$app->get('/books/{id}', function(Request $req, Response $res, array $args) use($app) {
  $booksRepository = $this->entityManager->getRepository('App\Models\Entity\Book');
  $book = $booksRepository->find($args['id']);

  if(!$book) {
    throw new \Exception("Book not found", 404);
  }

  return $res->withJson($book);
});

$app->put('/books/{id}', function(Request $req, Response $res, array $args) use ($app) {
  $params = (object) $req->getParams();

  $em = $this->entityManager;
  $booksRepository = $em->getRepository('App\Models\Entity\Book');

  $book = $booksRepository->find($args['id']);

  if(!$book) {
    throw new \Exception("Book not found", 404);
  }

  $book->setName($params->name);
  $book->setAuthor($params->author);

  $em->persist($book);
  $em->flush();

  return $res->withJson($book);
});

$app->delete('/books/{id}', function(Request $req, Response $res, array $args) use ($app) {
  $em = $this->entityManager;
  $booksRepository = $em->getRepository('App\Models\Entity\Book');
  $book = $booksRepository->find($args['id']);

  if(!$book) {
    throw new \Exception("Book not found", 404);
  }

  $em->remove($book);
  $em->flush();

  return $res->withJson([], 204);
});