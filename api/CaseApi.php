<?php

namespace CaseApi;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use CaseApi\EmailDB;

require_once "../vendor/autoload.php";
require_once "EmailDB.php";

class CaseApi
{
    public function getBtcUahPrice()
    {
        // Getting BTC/UAH price with Binance API
        $url = 'https://api.binance.com/api/v3/ticker/price';

        $incoming_data = @file_get_contents($url);

        // If we don't have access to third-party API - return "invalid" value
        if ($incoming_data === false)
        {
            return -1;
        }
        else
        {
            $json = json_decode($incoming_data, true);

            // 828 - position number in the JSON array
            // of the structure with the BTC/UAH price
            return intval($json[828]['price']);
        }
    }

    public function subscribe($email)
    {
        $edb = new EmailDB();

        return $edb->addEmail($email);
    }

    public function sendEmails()
    {
        // Configuring Gmail`s mail server
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = 'YOUR_MAIL';
        $mail->Password = 'YOUR_PASSWORD';
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->From = 'YOUR_MAIL';
        $mail->FromName = 'YOUR_NAME';

        // Getting email addresses from Email DB and
        // adding to Gmail`s mail server
        $edb = new EmailDB();

        $emails = $edb->getEmails();

        foreach ($emails as $email)
        {
            try
            {
                $mail->addBCC($email);
            }
            catch (Exception $e)
            {
            }
        }

        // Getting BTC/UAH price with our API
        $price = $this->getBtcUahPrice();
        // If the API is currently not working (API return -1) - stop sending
        if ($price < 0)
            return false;

        // Configuring email message
        $mail->Subject = 'BTC/UAH Price';
        $mail->Body = "1 btc = $price ₴";

        try
        {
            // Trying sent emails
            $mail->send();

            return true;
        }
        catch (Exception $e)
        {
            // Printing error of sending
            echo "Error: ".$mail->ErrorInfo;

            return false;
        }
    }
}