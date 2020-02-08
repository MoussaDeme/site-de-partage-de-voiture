<?php
    require_once("view/View.php");
    require_once("view/PrivateView.php");
    require_once("control/Controller.php");
    require_once("model/VoitureBuilder.php");
    require_once("lib/ObjectFileDB.php");
    require_once("model/VoitureStorageMySQL.php");
    require_once("model/AuthenticationManager.php");
    require_once("model/AccountSorageStub.php");
    require_once("model/userBuilder.php");
      class Router{
        public function main($pdo){
          //$view = new View($this);
          //$view = $this->createView();
          $view = null;
         $privateView; //= new PrivateView($this, $_SESSION['user']);
          //$view = Controller::testSession($this);
          $voitureStorageMySql = new VoitureStorageMySQL($pdo);
          $accountStorageStub = new AccountStorageStub($pdo);
          $authenticationManager = new AuthenticationManager($accountStorageStub);
           if(key_exists("user",$_SESSION)){
              $view = new PrivateView($this, $_SESSION['user']);
              $view->setMenu($view->getMenu());
            }else{
              $view = new View($this);
            }
          $controller = new Controller($view, $voitureStorageMySql,$authenticationManager);
          $tab = array("marque"=>'', "modele"=>'', "kilometrage"=>'', "annee"=>'');
          $voitureBuilder = new VoitureBuilder($tab);
          $tabUser = array("nom"=>'', "login"=>'', "password"=>'');
          $uBuilder = new UserBuilder($tabUser);
          if(key_exists("id", $_GET)){
            $controller->showInformation($_GET['id']);
          }elseif(key_exists("list", $_GET)) {
            $controller->showList();
          }elseif(key_exists("action", $_GET)) {
            if(key_exists("voiture", $_GET))
            {
              if($_GET['action']=="supprimer")
              {
                if($controller->askVoitureDeletion($_GET['voiture'])==true){
                   $controller->askingDeleteVoiture($_GET['voiture']);
                }else{
                  $view->makeErrorPage();
                }
              }
              if($_GET['action']=="ConfirmerSuppression")
              {
                $controller->deleteVoiture($_GET['voiture']);
              }
              if($_GET['action']=="FormsModif")
              {
                $controller->formsUpdate($_GET['voiture']);
              }
              if($_GET['action']=="modifier" && key_exists('modifier', $_POST))
              {
                $controller->UpdateVoiture($_GET['voiture'],$_POST);
              }
            }
            else{
            if($_GET['action']=="nouveau"){
               $view->makeCarCreationPage($voitureBuilder);
             }elseif($_GET['action']=="sauverNouveau"){
              if(key_exists('ajouter', $_POST)){
                $voitureBuilder = new VoitureBuilder($_POST);
               $controller->saveNewCar($voitureBuilder);
              }else{
                $view->makeErrorPage();
              }
             }else if($_GET['action']=="connecter")
             {
               $controller->connexionForm();

             }else if($_GET['action']=="ValiderConnexion" && key_exists('valider',$_POST))
             {
              $controller->controlAuthenticationManager($_POST);
              $_GET['action'] = "accueil";
              $view->sucessDisconnect();
            }else if($_GET['action']=="deconnecter")
             {
               $controller->disconnected();
               header('Location: voitures.php');
             } else if($_GET['action']=="inscription")
             {
              $view->makeUserCreationPage($uBuilder);
             }elseif($_GET['action']=="SauverInscription"){
              if(key_exists('valider', $_POST)){
                $userBuilder = new UserBuilder($_POST);
               $controller->saveNewUser($userBuilder);
              }else{
                $view->makeErrorPage();
              }
             }else if($_GET['action']=="propos")
             {
               $view->makeAproposPage();
             }
             else {
              $view->wellcomePage();
             }
            }
          }
          else{
            $view->wellcomePage();
          }
          $view->render();
        }

        public function getCarURL($id){
          return "voitures.php?id=".$id;
        }
        public function getCarCreationURL(){
            return "voitures.php?action=nouveau";
        }

        public function getCarSaveURL(){
            return "voitures.php?action=sauverNouveau";
        }

        public function getVoitureAskDeletionURL($id){
          return "voitures.php?voiture=".$id."&action=supprimer";
        }
        public function getVoitureDeletionURL($id)
        {
          return "voitures.php?voiture=".$id."&action=ConfirmerSuppression";
        }
        public function getFormsUpdateURL($id)
        {
          return "voitures.php?voiture=".$id."&action=FormsModif";
        }
        public function getCarUpdateURL($id)
        {
          return "voitures.php?voiture=".$id."&action=modifier";
        }
        public function getConnexion()
        {
          return "voitures.php?action=connecter";
        }
        public function getConneted()
        {
          return "voitures.php?action=ValiderConnexion";
        }
        public function getList()
        {
            return "voitures.php?list";
        }
        public function getDeconnected()
        {
          return "voitures.php?action=deconnecter";
        }
        public function getAcceuil()
        {
          return "voitures.php";
        }
        public function getInscription()
        {
           return "voitures.php?action=inscription";
        }
        public function getSaveInscriptionUrl()
        {
           return "voitures.php?action=SauverInscription";
        }
        public function getApropos()        {
          return "voitures.php?action=propos";
       }
      }
 ?>
