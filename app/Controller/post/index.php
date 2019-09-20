<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Plan;
use Model\Dao\Comment;

// 投稿ページのコントローラ
$app->get('/post', function (Request $request, Response $response) {


    //ログイン状態では無い場合、ログインページへリダイレクトします。
    if ($this->session["user_info"]["id"] == null) {
        //TOPへリダイレクト
        return $response->withRedirect('/login/');
    }

    $data = [];

    // Render index view
    return $this->view->render($response, 'post/add.twig', $data);
});

//投稿完了ページです。
$app->post('/post/done', function (Request $request, Response $response) {

    //ログイン状態では無い場合、ログインページへリダイレクトします。
    if ($this->session["user_info"]["id"] == null) {
        //TOPへリダイレクト
        return $response->withRedirect('/login/');
    }

    //POSTのデータを取得します
    $data = $request->getParsedBody();
    $data["user_id"] = $this->session["user_info"]["id"];
    $data["create_date"] = date("Y-m-d H:i:s");

    $plan = new Plan($this->db);
    $id = $plan->insert($data);

    // Render index view
    return $this->view->render($response, 'post/done.twig', $data);
});

//投稿一覧ページのコントローラ
$app->get('/post_list', function (Request $request, Response $response) {

    $data = $request->getQueryParams();
    $plan = new Plan($this->db);
    $data["result"] = $plan->select_plan();

    return $this->view->render($response, 'post_list/list.twig', $data);
});


//投稿詳細のコントローラです
$app->get('/post_list/{plan_id:[0-9]+}', function (Request $request, Response $response, $args) {

    $data = [];
    $plan = new Plan($this->db);
    $comment = new Comment($this->db);

    $data["result"] = $plan->get_detailplan($args["plan_id"]);
    $data["comment"] = $comment->get_detailcomment($args["plan_id"]);


    return $this->view->render($response, 'post_list/detail.twig', $data);
});
