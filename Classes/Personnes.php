<?php

include_once ('config.php');
class Personnes
{
    protected $username;
    protected $mail;
    protected $telephone;
    protected $Password;
    protected $Types;
    protected $ID;

    public static function GetmailFromID($id)
    {
        $conn = returnAConnexion();
        $stm = $conn->prepare('Select mail FROM user WHERE ID = ?');
        $stm->execute([$id]);
        $r = $stm->fetchAll()[0]['mail'];
        return $r;
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

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->Types;
    }

    /**
     * @param mixed $Types
     */
    public function setTypes($Types)
    {
        $this->Types = $Types;
    }

    /**
     * Personnes constructor.
     * @param $user
     * @param $mail
     * @param $telephone
     */
    public function __construct($user,$mail,$telephone,$Password,$ID,$Types)
    {
        $this->username = $user;
        $this->mail = $mail;
        $this->telephone = $telephone;
        $this->Password = $Password;
        $this->ID=$ID;
        $this->Types=$Types;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

}
?>