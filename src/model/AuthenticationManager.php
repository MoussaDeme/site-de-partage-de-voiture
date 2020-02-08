<?php
  class AuthenticationManager
  {

      private $accountStorageStub;

      public function __construct($accountStorageStub)
      {
           $this->accountStorageStub = $accountStorageStub;
           session_start();
      }
      public function connectUser($login, $password)
      {
          $ac = $this->accountStorageStub->checkAuth($login, $password);
          if($ac!=null)
          {
            $_SESSION['user'] = $ac;
            return true;
          }
          return false;
      }

      public function getAccountStorageStub()
      {
         return $this->accountStorageStub;
      }

      public function isUserConnected()
      {
           if(key_exists('user',$_SESSION))
           {
                return true;
           }
           return false;
      }
      public function isAdminConnected()
      {

          if($_SESSION['user']->getStatut()=='admin')
          {
              return true;
          }
          return false;
      }
      public function getUserName()
      {
           if(key_exists('user',$_SESSION))
           {
               return $_SESSION['user']->getNom();
           }
           // exception a faire
      }

      public function getAccount()
      {
           if(key_exists('user',$_SESSION))
           {
               return $_SESSION['user'];
           }
           // exception a faire
      }

      public function disconnectUser()
      {
        session_unset();
        session_destroy();
      }
  }
?>
