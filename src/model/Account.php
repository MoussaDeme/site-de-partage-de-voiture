<?php
    class Account{
      private $nom;
      private $login;
      private $password;
      private $statut;

      public function __construct($nom, $login, $password, $statut){
        $this->nom = $nom;
        $this->login = $login;
        $this->password = $password;
        $this->statut = $statut;

      }

      public function getNom(){
        return $this->nom;
      }

      public function getLogin(){
        return $this->login;
    }

    public function getPassword(){
      return $this->password;
    }
    public function getStatut()
    {
       return $this->statut;
    }
}
?>
