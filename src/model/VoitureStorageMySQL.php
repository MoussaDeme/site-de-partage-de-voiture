<?php
require_once("model/VoitureStorage.php");
require_once("model/Voiture.php");
require_once("model/Account.php");

class VoitureStorageMySQL implements VoitureStorage
{
    private $bd;
    public function __construct($bd)
     {
       $this->bd = $bd;
     }
    public function read($id)
     {

        $req = "select *FROM voiture where id=:identifiant";
        $stmt = $this->bd->prepare($req);
        $data = array(":identifiant" => $id);
        $stmt->execute($data);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if($res['id']){
        $voiture = new Voiture($res['marque'], $res['modele'], $res['kilometrage'], $res['annee']);
        return $voiture;
        }else 
        {
          return null;
        }
     }

     public function getUserLoginFromCar(Account $account,$id){
        $req ="SELECT *FROM voiture where login_fk=:login";
        $stmt = $this->bd->prepare($req);
        $data = array("login"=>$account->getLogin());
        $stmt->execute($data);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
         foreach($res as $key => $value)
         {
            if($value['id'] == $id)
            {
               return true;
            }
         }
         return false;
     }
     //renvoyer toute les anilaux dans la base de donnée
    public function readAll()
    {
        $requete = 'SELECT * FROM voiture;';
        $stmt = $this->bd->query($requete);
        $valeurs = $stmt->fetchAll();
	      $list = array();



        foreach ($valeurs as $key => $value) {
          $list[$value['id']] = new Voiture($value['marque'],$value['modele'],$value['kilometrage'],$value['annee']);
        }

        return $list;
    }
    public function create(Voiture $v)
    {
        $req = $this->bd->prepare('INSERT INTO voiture (marque, modele, kilometrage, annee) VALUES (:marque, :modele, :kilometrage, :annee)');

        $req->bindParam(':marque', $marque);
        $req->bindParam(':modele', $modele);
        $req->bindParam(':kilometrage', $kilometrage);
        $req->bindParam(':annee', $annee);

        $marque = $v->getMarque();
        $modele = $v->getModel();
        $kilometrage = $v->getKm();
        $annee = $v->getAnnee();

        $req->execute();
    }

     public function insertLoginUserInCar(Account $account, $carId){
        $req = $this->bd->prepare("UPDATE voiture SET login_fk=:login_fk WHERE id=".$carId);
        $req->execute(array('login_fk'=>$account->getLogin()));
     }

    public function delete($id){
        $req=$this->bd->prepare('delete   from voiture where id= :v');
        $req->execute(array('v'=>$id)); 
    }

        public function update($id, Voiture $v) {
          if ($this->read($id)!=null) {
            $req= $this->bd->prepare("UPDATE voiture SET marque= :marque, modele= :modele, kilometrage=:kilometrage, annee=:annee WHERE id=".$id);
            $req->execute(array('marque'=>$v->getMarque(),'modele'=>$v->getModel(),'kilometrage'=>$v->getKm(), 'annee'=>$v->getAnnee()));             
            return true;
          }
          return false;
        }

        public function getCarId(){
        $req = $this->bd->prepare("SELECT MAX(id) FROM voiture;");
        $req->execute();
        $id = $req->fetch();
        $id = $id['MAX(id)'];
        return $id;
     }
 }

?>
