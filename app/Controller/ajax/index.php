<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Plan;
// TOPページのコントローラ
$app->get('/ajax', function (Request $request, Response $response) {
    $data = $request->getQueryParams();
    $plan = new Plan($this->db);
    $good = $plan->add_good($data["planid"]);

    // Render index view
    print $good;
});
