<?php
    class Voiture{
      private $marque;
      private $model;
      private $kilometrage;
      private $annee;

      public function __construct($mar, $mod, $km, $an){
        $this->marque = $mar;
        $this->model = $mod;
        $this->kilometrage = $km;
        $this->annee = $an;
      }

      public function getMarque(){
        return $this->marque;
      }
      public function getModel(){
        return $this->model;
      }
      public function getKm(){
        return $this->kilometrage;
      }
      public function getAnnee(){
        return $this->annee;
      }
      public function setMarque($marque)
      {
        $this->marque=$marque;
      }
      public function setModel($model)
      {
        $this->model=$model;
      }
      public function setKm($km)
      {
        $this->kilometrage = $km;
      }
      public function setAnnee($annee)
      {
              $this->annee = $annee;
      }
    }
 ?>
