<?php
	require_once("Voiture.php");

    interface VoitureStorage{

      public function read($id);
      public function readAll();
      public function create(Voiture $v);
      public function delete($id);
      public function update($id, Voiture $v);
    }
 ?>
