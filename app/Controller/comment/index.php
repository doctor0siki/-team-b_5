<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Comment;

// comment/addページのコントローラ
$app->get('/comment/{plan_id:[0-9]+}', function (Request $request, Response $response, $args) {

  if($this->session["user_info"]["id"] == null)
  {
    //TOPへリダイレクト
    return $response->withRedirect('/login/');

  }
    $data = [];
    $data["plan_id"] = $args["plan_id"];
    // Render index view
    return $this->view->render($response, 'comment/add.twig', $data);
});


// comment/doneページのコントローラ
$app->post('/comment/done', function (Request $request, Response $response) {
    if($this->session["user_info"]["id"] == null)
{
  //TOPへリダイレクト
  return $response->withRedirect('/login/');

}
    $data = $request->getParsedBody();
    $data["user_id"] = $this->session["user_info"]["id"];
    $data["create_date"] = date("Y-m-d H:i:s");



    $comment = new Comment($this->db);
    $comment->insert($data);

    // Render index view
    return $this->view->render($response, 'comment/done.twig', $data);
});
