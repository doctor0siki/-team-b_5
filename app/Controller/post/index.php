<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Plan;

// TOPページのコントローラ
$app->get('/post', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'post/add.twig', $data);
});

$app->post('/post/done', function (Request $request, Response $response) {

    $data = $request->getParsedBody();
    $plan = new Plan($this->db);
    $id = $plan->insert($data);

    // Render index view
    return $this->view->render($response, 'post/done.twig', $data);
});


$app->get('/post_list/{plan_id}', function (Request $request, Response $response, $args) {
    // $data = $request->getQueryParams();
    // $plan = new Plan($this->db);
    // $data["result"] = $plan->select_plan();
    // Render index view
    $data = [];
    $plan = new Plan($this->db);
    $data["result"] = $plan->get_detailplan($args["plan_id"]);

    return $this->view->render($response, 'post_list/detail.twig', $data);
});
