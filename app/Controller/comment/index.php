<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Comment;

// comment/addページのコントローラ
$app->get('/comment/{plan_id}', function (Request $request, Response $response, $args) {

    $data = [];
    $plan_id = $args["plan_id"];

    // Render index view
    return $this->view->render($response, 'comment/add.twig', $data);
});


// comment/doneページのコントローラ
$app->post('/comment/done', function (Request $request, Response $response) {

    $data = $request->getParsedBody();
    $data["user_id"] = $this->session["user_info"]["id"] ;
    $data["create_date"] = date("Y-m-d H:i:s");



    $comment = new Comment($this->db);
    $comment->insert($data);

    // Render index view
    return $this->view->render($response, 'comment/done.twig', $data);
});
