<?php
class user
{
    private $nom;
    private $login;
    private $password;
    private $statut;
    public function __conctruct($nom,$login,$password,$statut)
    {
        $this->nom = $nom;
        $this->login = $login;
        $this->password = $password;
        $this->statut = $statut;
    }
    //gettters
    public function getNom()
    {
        return $this->nom;
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getStatut()
    {
        return $this->statut;
    }
    //setters
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    public function setNom($login)
    {
        $this->login = $login;
    }
    public function setNom($password)
    {
        $this->password = $password;
    }
    public function setNom($statut)
    {
        $this->statut = $statut;
    }
}

?>