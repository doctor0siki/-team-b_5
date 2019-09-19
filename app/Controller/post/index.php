<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Plan;

// TOPページのコントローラ
$app->post('/post', function (Request $request, Response $response) {

    $data = [];
    $data["id"] = "";
    $data["title"] = "";
    $data["sub-title"] = "";
    $data["detail"] = "";
    $data["place"] = "";
    $data["cat_code"] = "";
    $data["create_date"] = "";
    $data["user_id"] = "";
    $data["good"] = "";
    $data["img_url"] = "";
    $data["visit_date"] = "";
    $plan = new Plan($this->db);
    $result = $plan->search_plan($data);
    dd($result);
    // Render index view
    return $this->view->render($response, 'post/input.twig', $data);
});
