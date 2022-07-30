<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once "../vendor/autoload.php";

    // Setting JSON text content type
    header('Content-Type: application/json; charset=utf-8');

    // Configuring Gmail`s mail server
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = 'mailer.kilko@gmail.com';
    $mail->Password = 'gtczpnksgngvyhub';
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->From = 'mailer.kilko@gmail.com';
    $mail->FromName = 'Mailer Kilko';
    
    // Getting email addresses from file DB and adding to Gmail`s mail server
    $file_name = '../emails.txt';
    $file = fopen($file_name, 'r');
    $num = 1;
    while(!feof($file)) {
        $email = trim(fgets($file));
        $mail->addBCC($email);
        $num++;
    }
    fclose($file);

    // Getting BTC/UAH price with our API
    $url = 'http://localhost:8080/api/rate.php';
    $data = file_get_contents($url);
    $json = json_decode($data, true);
    $price = $json;

    // If the API is currently not working (API return empty string) - stop sending
    if($price == '')
        exit;

    $mail->Subject = 'BTC/UAH Price';
    $mail->Body = "1 btc = $price ₴";

    try {
        // Trying sent emails
        $mail->send();

        // Setting status 200 emails were sent
        http_response_code(200);
    } catch (Exception $e) {
        echo "Error: ".$mail->ErrorInfo;
    }


