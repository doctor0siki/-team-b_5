<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Plan;


$app->get('/post_list', function (Request $request, Response $response) {

    $data = $request->getQueryParams();
    $plan = new Plan($this->db);
    $data["result"] = $plan->select_plan();
    // Render index view
    return $this->view->render($response, 'post_list/list.twig', $data);
});
