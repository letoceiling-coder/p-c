<?php

namespace classed;



class RouteException extends \Exception
{

    protected $messages;
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
        $this->messages = include 'classed/messages.php';

        $error = $this->getMessage() ? $this->getMessage(): $this->messages->getCode();
        $error .= "\r\n" . 'file' . $this->getFile() ."\r\n". "In line " . $this->getLine() . "\r\n";

        if ($this->messages[$this->getCode()]) $this->message = $this->messages[$this->getCode()];

        BaseController::writeLog($error);

    }
}