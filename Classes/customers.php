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

    /**
     * customers constructor.
     * @param $arrayIntRequest
     */
    public function recupUserOnPMysql($user,$mail,$tel,$Password,$array)
    {
        self($user,$mail,$tel,$Password);
        $this->MysqlToarray($array);
    }
    public function addRequestInt($int)
    {
        array_push($this->arrayIntRequest,$int);
    }
    public function ArrayToMySQL()
    {
       return implode(",",$this->arrayIntRequest);
    }
    public function MysqlToarray($string)
    {
        $array = explode(",",$string);
        $this->arrayIntRequest = array();
        foreach ($array as $value)
        {
            if(is_numeric($value))
            {
                array_push($this->arrayIntRequest,intval($value));
            }
        }
    }


}