<?php

/* Class qui va servir a générer les erreurs */
class MyError{

    private $_code;
    private $_message;
    private $_time;

    function __construct($code = 0, $message = ""){
        $this->_code = $code;
        $this->_message = $message;
        $this->_time = new DateTime("now", new DateTimeZone("Europe/Paris"));
    }
    
    function __toString(){
        return ($this->_code != 0) ? "[".$this->_time->format("Y-m-d H:i:s")."] Error ".$this->_code." : " .$this->_message : "";
    }

    function setError($code = 0, $message = ""){
        $this->_code = $code;
        $this->_message = $message;
        $this->_time = new DateTime("now", new DateTimeZone("Europe/Paris"));
    }
}



