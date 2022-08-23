<?php

    use CaseApi\CaseApi;

    require_once "CaseApi.php";

    // Setting JSON text content type
    header('Content-Type: application/json; charset=utf-8');

    $api = new CaseApi();

    $price = $api->getBtcUahPrice();

    if ($price >= 0)
    {
        // Setting status 200 OK
        http_response_code(200);

        // Returning integer
        echo $price;
    }
    else
    {
        // Setting 400 Invalid status value
        http_response_code(400);
    }
