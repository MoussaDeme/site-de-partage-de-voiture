<?php
    require_once("model/Voiture.php");
    require_once("Router.php");

      class View{
        private $title;
        private $content;
        private $router;
        private $menu;

        public function __construct(Router $r){
          $this->router = $r;
          $this->title = null;
          $this->content = null;
          $this->menu='<li class="nav-item"><a class="nav-link" href="'.$this->router->getAcceuil().'">Acceuil</a></li>';
          $this->menu.='<li class="nav-item"><a class="nav-link" href="'.$this->router->getList().'">Liste des voitures</a></li>';
          $this->menu.='<li class="nav-item"><a class="nav-link" href="'.$this->router->getInscription().'">s\'inscrire</a></li>';
          $this->menu.='<li class="nav-item"><a class="nav-link" href="'.$this->router->getConnexion().'">Connexion</a></li>';
          $this->menu.='<li class="nav-item"><a class="nav-link" href="'.$this->router->getApropos().'">A propos</a></li>';
        }
        
      public function getContent()
      {
          return $this->content;
      }
      public function setContent($content)
      {
        $this->content = $content;
      }
      public function getMenu()
      {
          return $this->menu;
      }

      public function setMenu($menu)
      {
        $this->menu = $menu;
      }
      public function getRouter()
      {
          return $this->router;
      }

        public function render(){
          if ($this->title === null || $this->content === null) {
            $this->makeUnknownCarPage();
          }else{
            include("squelette.php");
          }
        }

        public function makeTestPage(){
          $this->title = "Text du titre";
          $this->content = "Text du contenu";
        }
        public function makeCarPage(Voiture $v,$id){
          $this->title = "Page sur <strong>".$v->getModel()."</strong>";
          $s = "<strong>".$v->getModel()."</strong> est une voiture de marque <strong>".$v->getMarque()."</strong>
                          <br/> Son Kilomètrage est : <strong>".$v->getKm()."
                          <br/> </strong> et son année de fabrication est : <strong>".$v->getAnnee()."</strong> <br/>";
         //$id=2;
         $supp = "supprimmer";
         //echo "<a href=\"".$this->router->getVoitureAskDeletionURL($id)."suppimmer";
         $modif = "modifier";
         $s.=  "<a href=".$this->router->getVoitureAskDeletionURL($id).">".$supp."</a><br/>";
         $s.= "<a href=".$this->router->getFormsUpdateURL($id).">".$modif."</a><br/>";

         $this->content = $s;
        }

        public function makeCarPageNotConnected(Voiture $v,$id){
          $this->title = "Page sur <strong>".$v->getModel()."</strong>";
          $s = "<strong>".$v->getModel()."</strong> est une voiture de marque <strong>".$v->getMarque()."</strong>
                          <br/> Son Kilomètrage est : <strong>".$v->getKm()."
                          <br/> </strong> et son année de fabrication est : <strong>".$v->getAnnee()."</strong> <br/>";

         $this->content = $s;
        }

        public function makeUnknownCarPage(){
          $this->title = 'ERREUR';
          $this->content = 'PAGE INCONNU';
        }

        public function makeErrorPage(){
          $this->title = 'ERREUR';
          $this->content = 'ERREUR';
        }

        public function wellcomePage(){
          $this->title = "Proposez vos voiture !";
          $this->content = "Bienvenue sur ce site de partage de voiture.";
          $this->content.="<div class=\"row\"><img class=\"img-responsive col-lg-8\"  src=\"voiture.jpg\" alt=\"\"/></div>";
          //$this->content.="<img src=\"images/voiture8.jpg\" class=\"rounded-thumnail mx-auto d-block\">";
            
      
        }

        public function carCreationFaillure(){
          $this->title="Erreur !";
          $this->content = "Vous devez vous connecter avant d'ajouter une voiture";
        }

        public function makeListPage(VoitureStorage $data){
          $this->title = "LISTE DES VOITURES";
          $tab = $data->readAll();
          $s='';
          $s.="<div class=\"list-group\">";
          foreach($tab as $key => $value){
            $s.="<a href=".$this->router->getCarURL($key)."class=\"list-group-item list-group-item-action\">".$value->getModel()."</a><br/>";
          }
          $s.="</div>";
          $this->content = $s;
        }

        public function makeDebugPage($variable) {
            $this->title = 'Debug';
            $this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
        }


        public function makeCarCreationPage(VoitureBuilder $vb){
          $this->title = 'AJOUT D\'UNE VOITURE';
          $s = '';
          $s.= $vb->getError();

      $s.='<form action="'.$this->router->getCarSaveURL().'" method="post">'."\n";
      $s.= '<div class="form-group "><h3> Ajout d\'une nouvellle voiture </h3>';
      $s.=  '<div class="form-group"><label for="staticEmail" class="col-sm-2 col-form-label">Marque : </label><input type="text" name="'.VoitureBuilder::MARQUE_REF.'" value="'.$vb->getData()[VoitureBuilder::MARQUE_REF].'" />  </div><br/>'."\n";
      $s.=  '<div class="form-group"><label for="staticEmail" class="col-sm-2 col-form-label">Modèle :  </label><input type="text" name="'.VoitureBuilder::MODELE_REF.'" value="'.$vb->getData()[VoitureBuilder::MODELE_REF].'" /></div> <br/>'."\n";
      $s.=  '<div class="form-group"><label for="staticEmail" class="col-sm-2 col-form-label">Kilomètrage : </label><input type="text" name="'.VoitureBuilder::KM_REF.'" value="'.$vb->getData()[VoitureBuilder::KM_REF].'" /> </div> <br/>'."\n";
      $s.=  '<div class="form-group"><label for="staticEmail" class="col-sm-2 col-form-label">Année : </label><input type="text" name="'.VoitureBuilder::ANNEE_REF.'" value="'.$vb->getData()[VoitureBuilder::ANNEE_REF].'"/> </div> <br/>'."\n";
      $s.=  '<button type="submit" name="ajouter">Ajouter</button>'."\n";
      $s.='</div></form>';
    $this->content = $s;
    }
    //page de suppression
        public function makeVoitureDeletionPage($id)
        {
          $this->title =  'page de suppression d\'une voiture';
          $s =  '<form action="'.$this->router->getVoitureDeletionURL($id).'" method="POST">';
         $s.= "<button>Confirmer</button>\n</form>\n";
         $this->content = $s;
        }
        //page sur la modification
        public function makeCarUpdatePage($id,Voiture $vb){
          //echo $vb->getError();
          $this->title = 'MODIFICATION D\'UNE VOITURE'.

      $s='';
     $s.= '<form action="'.$this->router->getCarUpdateURL($id).'" method="POST">';

              $s.='<div class="form-group "><div class="form-group"><label for="staticEmail" class="col-sm-2 col-form-label">Marque : </label><input type="text" name="marque" value="'.$vb->getMarque().'" />  </div><br/>';
              $s.='<div class="form-group"><label for="staticEmail" class="col-sm-2 col-form-label">Modèle :  </label><input type="text" name="modele" value="'.$vb->getModel().'" /> </div><br/>';
              $s.='<div class="form-group"><label for="staticEmail" class="col-sm-2 col-form-label">Kilomètrage : </label><input type="text" name="km" value="'.$vb->getKm().'" />  </div><br/>';
              $s.='<div class="form-group"><label for="staticEmail" class="col-sm-2 col-form-label">Année : </label><input type="text" name="annee" value="'.$vb->getAnnee().'"/> </div><br/>';
              $s.='<button type="submit" name="modifier">Modifier</button>';
           $s.='</div></form>';
           $this->content = $s;
    }
    public function AfterModifiedPage()
    {
      $this->title = 'Voiture Modifier';
      $this->content = 'voiture modifier avec succees';
    }
    public function makeLoginFormPage()
    {
      $this->title = "FORMULAIRE DE CONNEXION";
     $s='';
     $s.= '<form action="'.$this->router->getConneted().'" method="POST">';
     $s.='<div class="form-group"><label >LOGIN : <input type="text" name="login" value="" class="form-control" /> </label></div> <br/>';
     $s.='<div class="form-group"><label >MOT DE PASSE : <input type="password" name="password" value="" class="form-control"  /> </label></div> <br/>';
     $s.='<button type="submit" name="valider" class="btn btn-primary">VALIDER</button>';
     $s.='</form>';
     $this->content = $s;
    }

    public function sucessDisconnect(){
        $this->title = 'Déconnexion';
        $this->content = 'Déconnexion réussie <meta http-equiv="refresh" content="0">';

    }

    public function makeUserCreationPage(UserBuilder $u){
   $this->title = 'FORMULAIRE D\'INSCRIPTION';
   $s = '';
   $s.= $u->getError();

$s.='<form action="'.$this->router->getSaveInscriptionUrl().'" method="post">'."\n";
$s.= '<div class="form-group "><h3> INSCRIPTION </h3>';
$s.=  '<div class="form-group"><label for="staticEmail" class="col-sm-2 col-form-label">NOM :   </label><input type="text" name="'.UserBuilder::NOM_REF.'" value="'.$u->getData()[UserBuilder::NOM_REF].'" /> </div> <br/>'."\n";
$s.=  '<div class="form-group"><label for="staticEmail" class="col-sm-2 col-form-label">LOGIN : </label><input type="text" name="'.UserBuilder::LOGIN_REF.'" value="'.$u->getData()[UserBuilder::LOGIN_REF].'" /> </div> <br/>'."\n";
$s.=  '<div class="form-group"><label for="staticEmail" class="col-sm-2 col-form-label">MOT DE PASSE : </label><input type="password" minlength="6" name="'.UserBuilder::PASSWORD_REF.'" value="" /></div> <br/>'."\n";
$s.=  '<button type="submit" name="valider">VALIDER</button>'."\n";
$s.='</div></form>';
$this->content = $s;
}
public function makeAproposPage()
   {
     $this->title = "A PROPOS";
     $s = "site realiser par <strong> 21912873 </strong> et <strong> 21814195 </strong> <br/>";
     $s.= "Choix du sujet: <br/>";
     $s.= "De nos jours, tout le monde a besoin de vendre ou d'acheter un objet. Parmis ces objets il y a des voitures, des appareils etc... <br/>";
     $s.=" On a jougé nécessaire de créer un site pour mettre ces personnes en relation. Pour l'instant on ne peut que créer, modifier et supprimer une voiture selon les droits d'accès. <br/> Mais y aura des améliorations telles que: Un forum de discussion pour les utilisateurs du site pour pouvoir échanger entre vendeurs et acheteurs ";
     $s.="<br/> Le login de l'<strong>admin</strong> est <strong>toto@gmail.com</strong> et son mot de passe est <strong>totototo</strong> ";
     $this->content = $s;
   }
   }
 ?>
