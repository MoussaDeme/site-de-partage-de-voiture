<?php
		class VoitureBuilder{
			private $data;
			private $error;
			const MARQUE_REF = "marque";
			const MODELE_REF = "modele";
			const KM_REF = "kilometrage";
			const ANNEE_REF = "annee";

			public function __construct($d){
				$this->data = $d;
				$this->error = null;
			}

			public function createCar(){
              $voiture = new Voiture(htmlspecialchars($this->data[self::MARQUE_REF]), htmlspecialchars($this->data[self::MODELE_REF]),
							htmlspecialchars($this->data[self::KM_REF]), htmlspecialchars($this->data[self::ANNEE_REF]));
           	  return $voiture;
		  }
		  /*public function updateVoitureBuilder(Voiture $v) {
			if (key_exists(self::MARQUE_REF, $this->data))
				$v->setMarque($this->data[self::MARQUE_REF]);
			if (key_exists(self::MODELE_REF, $this->data))
				$v->setModel($this->data[self::MODELE_REF]);
			if (key_exists(self::KM_REF, $this->data))
				$v->setKm($this->data[self::KM_REF]);
			if (key_exists(self::ANNEE_REF, $this->data))
				$v->setAnnee($this->data[self::ANNEE_REF])
		  }*/
          public function getData(){
          	return $this->data;
          }         
          public function isValid(){
          	 if(($this->data[self::MARQUE_REF]!="") && ($this->data[self::MODELE_REF]!="") && ($this->data[self::KM_REF]!="") && ($this->data[self::ANNEE_REF]!="")){
              $this->error=null;
            }else{
              if($this->data[self::MARQUE_REF]==""){
                $this->error .= "Le chmaps Marque doit être rempli ";
              }
              if($this->data[self::MODELE_REF]==""){
                $this->error .= "Le champs Modèle doit être rempli ";
              }
              if($this->data[self::KM_REF]==""){
                $this->error .= "Le champs Kilomètrage doit être rempli";
              }
             if($this->data[self::ANNEE_REF]==""){
              	$this->error .= "Le champs Année doit être rempli";
              }
            }
		 }

		public function getError(){
			return $this->error;
		}
	}
 ?>
