<?php
	require_once("view/View.php");
	class PrivateView extends View
	{
		private $account;

		public function __construct($r, $account){
			parent::__construct($r);
			$this->account = $account;

		}
	  public function getMenu()
      {
    				$s='<li class="nav-item"><a class="nav-link" href="'.parent::getRouter()->getAcceuil().'">Acceuil</a></li>';
						$s.='<li class="nav-item"><a class="nav-link" <a href="'.parent::getRouter()->getList().'">Liste des voitures</a><li>';
            $s.='<li class="nav-item"><a class="nav-link" <a href="'.parent::getRouter()->getCarCreationURL().'">Créer une voiture</a></li>';
            $s.='<li class="nav-item"><a class="nav-link" <a href="'.parent::getRouter()->getDeconnected().'">Deconnexion</a></li>';

			return $s;
      }
      public function wellcomePage(){
      		parent::wellcomePage();
      		$s = "Bonjour <strong>".$this->account->getNom()."</strong> <br/>";
      		$s.=parent::getContent();
      		parent::setContent($s);
        }
	}
 ?>
