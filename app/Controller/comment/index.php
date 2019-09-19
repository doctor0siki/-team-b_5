<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Comment;

// comment/addページのコントローラ
$app->get('/comment/add', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'comment/add.twig', $data);
});

// comment/detailページのコントローラ
$app->get('/comment/{plan_id}', function (Request $request, Response $response, $args) {

    $data = [];
    $plan_id = $args["plan_id"];

    $comment = new Comment($this->db);

    $result = $comment->select($param,"","",5,true);
dd($result);


    // Render index view
    return $this->view->render($response, 'comment/detail.twig', $data);
});

// comment/doneページのコントローラ
$app->post('/comment/done', function (Request $request, Response $response) {

    $data = [];
    $data["id"] = 6;
    $data["user_id"] = 1;
    $data["plan_id"] = 1;
    $data["create_date"] = date("Y-m-d H:i:s");
    $data["text"] = "面白そう";






    $comment = new Comment($this->db);
    $comment->insert($data);

    // Render index view
    return $this->view->render($response, 'comment/done.twig', $data);
});
