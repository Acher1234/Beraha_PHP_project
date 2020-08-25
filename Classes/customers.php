<?php

include_once 'Personnes.php';
class customers extends Personnes
{

    /**
     * customers constructor.
     * @param $arrayIntRequest
     */
    public function __construct($user,$mail,$tel,$Password,$ID,$types)
    {
        Personnes::__construct($user,$mail,$tel,$Password,$ID,$types);
    }


    /**
     *
     */
    public function getTest()
    {
        return "Test";
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

}
?>