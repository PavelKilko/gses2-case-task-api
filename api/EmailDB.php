<?php

namespace CaseApi;

class EmailDB
{
    private $filename = "../emails.txt";

    public function __construct()
    {
        $fp = fopen($this->filename, "a");
        fclose($fp);
    }

    public function addEmail($email)
    {
        if (!$this->isExist($email))
        {
            file_put_contents($this->filename,
                $email . PHP_EOL,
                FILE_APPEND);

            return true;
        }
        else
        {
            return false;
        }
    }

    public function isExist($email)
    {
        $emails = $this->getEmails();

        foreach ($emails as $value)
        {
            if ($value === $email)
            {
                return true;
            }
        }

        return false;
    }

    public function getEmails()
    {
        return explode(PHP_EOL, file_get_contents($this->filename));
    }
}