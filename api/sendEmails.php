<?php

    use CaseApi\CaseApi;

    require_once "CaseApi.php";

    // Setting JSON text content type
    header('Content-Type: application/json; charset=utf-8');

    $api = new CaseApi();

    if ($api->sendEmails())
    {
        // Success sending
        http_response_code(200);
    }
    else
    {
        // Failure sending
        http_response_code(400);
    }


