<?php
    require_once("view/View.php");
    require_once("model/Voiture.php");
    require_once("model/VoitureStorage.php");
    require_once("model/VoitureStorageMySQL.php");

      class Controller{

        private $view;
        private $voitureStorageMySql;
        private $authenticationManager;

        public function __construct(View $view, VoitureStorage $vs, AuthenticationManager $authenticationManager){
          $this->view = $view;
          $this->voitureStorageMySql = $vs;
          $this->authenticationManager = $authenticationManager;
        }

        public function showInformation($id){
          $state = $this->voitureStorageMySql->read($id);
          if($state!=null){
            $account = $this->authenticationManager->getAccount();
            //var_export($this->voitureStorageMySql->getUserLoginFromCar($account));
            if($this->authenticationManager->isUserConnected()==true){
            if(($this->voitureStorageMySql->getUserLoginFromCar($account,$id)==true) || $this->authenticationManager->isAdminConnected()==true){
                $this->view->makeCarPage($state,$id);
                }else{
                $this->view->makeCarPageNotConnected($state,$id);
              }
            }else{
              $this->view->makeCarPageNotConnected($state,$id);
            }
          }else{
            $this->view->makeUnknownCarPage();
          }
        }

        public function showList(){
          $this->view->makeListPage($this->voitureStorageMySql);
        }

        public function saveNewCar(VoitureBuilder $voitureBuilder){
          if($this->authenticationManager->isUserConnected()==true){
                $voitureBuilder->isValid();
                if($voitureBuilder->getError()==null){
                    $this->voitureStorageMySql->create($voitureBuilder->createCar());
                    $this->voitureStorageMySql->insertLoginUserInCar($this->authenticationManager->getAccount(),$this->voitureStorageMySql->getCarId());
                    $this->showInformation($this->voitureStorageMySql->getCarId());
                }else{
                       $this->view->makeCarCreationPage($voitureBuilder);
                      }
          }else{
            $this->view->carCreationFaillure();
          }

        }


        //suppresion de voiture
        public function askingDeleteVoiture($voitureId) {

            $this->view->makeVoitureDeletionPage($voitureId);
          //}
        }
       public function askVoitureDeletion($id)
       {
        $voiture = $this->voitureStorageMySql->read($id);
        if($voiture!=null)
        {
           return true;
        }else
        {
          return false;
        }
       }
       public function deleteVoiture($id)
       {
        $this->voitureStorageMySql->delete($id);
       }
       public function formsUpdate($id)
       {
            $vb = $this->voitureStorageMySql->read($id);
            $this->view->makeCarUpdatePage($id,$vb);
       }
       public function UpdateVoiture($id, array $data)
       {
          $v = $this->voitureStorageMySql->read($id);

          $v->setMarque($data['marque']);
          $v->setModel($data['modele']);
          $v->setKm($data['km']);
          $v->setAnnee($data['annee']);
          $this->voitureStorageMySql->update($id,$v);
          $this->view->AfterModifiedPage();
      }
      // accees au formulaire de connexion
      public function connexionForm()
      {
        $this->view->makeLoginFormPage();
      }
      public function controlAuthenticationManager(array $data)
      {
          if($this->authenticationManager->connectUser($data['login'],$data['password']) == true)
          {
             $this->view->wellcomePage();
          }else{
            $this->view->makeErrorPage();
          }
      }
      public function disconnected()
      {
          $this->authenticationManager->disconnectUser();
          $this->view->wellcomePage();
          //$_GET['action'] = "accuee";
          //$this->view->sucessDisconnect();
      }

     // setter pour la View
     public function setView($view)
     {
        $this->view = $view;
     }

      public function saveNewUser(UserBuilder $u){
       $u->isValid();
    if($u->getError()==null){
      //$this->controlAuthenticationManager->create($u->createUser());
      $this->authenticationManager->getAccountStorageStub()->create($u->createUser());
      $this->view->wellcomePage();
      $s = $this->view->getContent();
      $s.="<br /> inscription reussi";
      $this->view->setContent($s);

      // $this->view->makeDebugPage($voitureBuilder->getData());
    }else{
        $this->view->makeUserCreationPage($u);
      }
    }

    }
 ?>
