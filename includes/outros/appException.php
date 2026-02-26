<?php
class AppException extends Exception {
    private $type;

    public function __construct($message, $type = 'error', $code = 400) {
        parent::__construct($message, $code);
        $this->type = $type;
    }

    public function getType() { return $this->type; }
}