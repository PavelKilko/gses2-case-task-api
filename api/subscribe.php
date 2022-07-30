<?php
    // Getting email address from POST request
    $email = $_POST['email'];

    // Getting all existing email addresses from a file DB
    $file_name = '../emails.txt';
    $file = fopen($file_name, 'r');
    $file_size = filesize($file_name);
    if($file_size)
        $file_data = fread($file, $file_size);
    else
        $file_data = '';
    fclose($file);

    // Checking whether this email address is in the file DB
    $position = strpos($file_data, $email);
    if($position !== false) {
        // Setting 409 email address in the file DB
        http_response_code(409);
    } else {
        // Setting 200 email address added in the file DB
        http_response_code(200);

        // Adding email address in the file DB
        $file = fopen($file_name, 'a');
        fwrite($file, $email.PHP_EOL);
        fclose($file);
    }