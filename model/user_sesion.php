<?php
   
  class userSession{
      public function construct(){}
      public function setCurrentUser($id){
          session_start();
          $_SESSION['id'] = $id;
      }
      public function getCurrenIDuser(){
          session_start();
          return $_SESSION['id'];
      }
      public function closedSession(){
          session_unset();
          session_destroy();
      }
  }
?>