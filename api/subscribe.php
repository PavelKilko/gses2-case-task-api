<?php

    use CaseApi\CaseApi;

    require_once "CaseApi.php";

    // Getting email address from POST request
    $email = $_POST['email'];

    $api = new CaseApi();

    if ($api->subscribe($email))
    {
        // Email was added to Email DB
        http_response_code(200);
    }
    else
    {
        // Email was already in Email DB
        http_response_code(409);
    }