<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'post/create.twig', $data);
});

// TOPページのコントローラ
$app->get('/sample', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'sample/index.twig', $data);
});
