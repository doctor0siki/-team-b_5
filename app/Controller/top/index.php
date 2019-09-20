<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Plan;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

    $data = [];
    $plan = new Plan($this->db);
    $data["result"] = $plan->select_plan();
    // Render index view
    return $this->view->render($response, 'top-page/first-page.twig', $data);
});

// TOPページのコントローラ
$app->get('/sample', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'sample/index.twig', $data);
});
