<?php
      require_once("model/AccountSorage.php");
      require_once("model/Account.php");

    class AccountStorageStub implements AccountStorage{
        private $bd;
        public function __construct($bd)
         {
           $this->bd = $bd;
         }
        public function checkAuth($login, $password)
        {
            $req = "select *FROM users where login=:login AND password=:password;";
            $stmt = $this->bd->prepare($req);
            $data = array(":login" => $login,":password" => $password);
            $stmt->execute($data);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            if($res['login']!=null && $res['password']!=null){
             $account = new Account($res['nom'], $res['login'], $res['password'], $res['statut']);
             return $account;
            }
            else
           {
             return null;
           }
        }

        public function listOfAccount()
        {
          $requete = 'SELECT * FROM users;';
          $stmt = $this->bd->query($requete);
          $valeurs = $stmt->fetchAll();
          $list = array();
          foreach ($valeurs as $key => $value) {
            $list[$key] = new Account($value['nom'],$value['login'],$value['password'],$value['statut']);
          }
          return $list;
        }

        public function create(Account $a){
  $req = $this->bd->prepare('INSERT INTO users (nom, login, password, statut) VALUES (:nom, :login, :password, :statut)');

  $req->bindParam(':nom', $nom);
  $req->bindParam(':login', $login);
  $req->bindParam(':password', $password);
  $req->bindParam(':statut', $statut);

  $nom = $a->getNom();
  $login = $a->getLogin();
  $password = $a->getPassword();
  $statut = 'user';
  $req->execute();
}
    }
?>
