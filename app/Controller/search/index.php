<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Plan;

// TOPページのコントローラ
$app->get('/search', function (Request $request, Response $response) {

    $data = [];
    $data["word"] = "東京";
    $result = $plan->search_plan($data);
    dd($result);
    // Render index view
    return $this->view->render($response, 'search/list.twig', $data);
});
