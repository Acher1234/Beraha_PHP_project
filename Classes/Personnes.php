<?php

class Personnes
{
    protected $username;
    protected $mail;
    protected $telephone;
    protected $Password;

    /**
     * Personnes constructor.
     * @param $user
     * @param $mail
     * @param $telephone
     */
    public function __construct($user,$mail,$telephone,$Password)
    {
        $this->username = $user;
        $this->mail = $mail;
        $this->telephone = $telephone;
        $this->Password = $Password;
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