<?php


class customers extends Personnes
{
    private $arrayIntRequest;

    /**
     * customers constructor.
     * @param $arrayIntRequest
     */
    public function __construct($user,$mail,$tel,$Password)
    {
        Personnes::__construct($user,$mail,$tel,$Password);
        $this->arrayIntRequest = array();
    }


    public function addRequestInt($int)
    {
        array_push($this->arrayIntRequest,$int);
    }


}