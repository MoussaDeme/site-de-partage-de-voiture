<?php
  class userBuilder
  {
    private $data;
    private $error;
    const NOM_REF = "nom";
    const LOGIN_REF = "login";
    const PASSWORD_REF = "password";


    public function __construct($d){
      $this->data = $d;
      $this->error = null;
    }

    public function createUser(){
            $account = new Account(htmlspecialchars($this->data[self::NOM_REF]), htmlspecialchars($this->data[self::LOGIN_REF]),
            htmlspecialchars($this->data[self::PASSWORD_REF]),null);
             return $account;
    }

    public function getData(){
      return $this->data;
    }

    public function isValid(){
      if(($this->data[self::NOM_REF]!="") && ($this->data[self::LOGIN_REF]!="") && ($this->data[self::PASSWORD_REF]!="")){
       $this->error=null;
     }else{
       if($this->data[self::NOM_REF]==""){
         $this->error .= "Le chmaps NOM doit être rempli ";
       }
       if($this->data[self::LOGIN_REF]==""){
         $this->error .= "Le champs LOGIN doit être rempli ";
       }
       if($this->data[self::PASSWORD_REF]==""){
         $this->error .= "Le champs PASSWORD doit être rempli";
       }
     }
}

     public function getError(){
         return $this->error;
     }
  }
?>
