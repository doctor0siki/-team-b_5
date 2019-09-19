<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Plan;

// TOPページのコントローラ
$app->get('/post', function (Request $request, Response $response) {

    // Render index view
    return $this->view->render($response, 'post/add.twig', $data);
});

$app->post('/post/done', function (Request $request, Response $response) {

    $data = $request->getParsedBody();
    $plan=new Plan($this->db);
    $id = $plan->insert($data);

   // Render index view
    return $this->view->render($response, 'post/done.twig', $data);
});
