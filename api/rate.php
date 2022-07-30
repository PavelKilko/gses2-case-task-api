<?php
    // Setting JSON text content type
    header('Content-Type: application/json; charset=utf-8');

    // Getting BTC/UAH price with Binance API
    $url = 'https://api.binance.com/api/v3/ticker/pricfe';
    $incoming_data = file_get_contents($url);
    $json = json_decode($incoming_data, true);

    // 828 - position number in the JSON array of the structure with the BTC/UAH price
    $price = intval($json[828]['price']);


    if($price) {
        // Setting status 200 OK
        http_response_code(200);

        // Returning integer
        echo $price;
    } else {
        // Setting 400 Invalid status value
        http_response_code(400);
    }
