<?php

class Message
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function setMessage($msg, $type, $text , $redirectPage = "index.php")
    {

        $_SESSION["msg"] = $msg;
        $_SESSION["type"] = $type;
        $_SESSION["text"] = $text;

        if ($redirectPage != "back") {
            header("Location: $this->url" . $redirectPage);
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    public function getMessage()
    {
        if (!empty($_SESSION["msg"])) {
            return [
                "msg" => $_SESSION["msg"],
                "type" => $_SESSION["type"],
                "text" => $_SESSION["text"]
            ];
        } else {
            return false;
        }
    }

    public function clearMessage()
    {
        $_SESSION["msg"] = "";
        $_SESSION["type"] = "";
        $_SESSION["text"] = "";
    }
}
