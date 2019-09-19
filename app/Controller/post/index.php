<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Plan;

// TOPページのコントローラ
$app->get('/post', function (Request $request, Response $response) {
dd("aaaaa");


    $result = $plan->search_plan($data);

    // Render index view
    return $this->view->render($response, 'post/input.twig', $data);
});

$app->get('/post/done', function (Request $request, Response $response) {
dd("aaaaa");

    $data = $request->getParsedBody();
    
    $result = $plan->search_plan($data);

    // Render index view
    return $this->view->render($response, 'post/input.twig', $data);
});
