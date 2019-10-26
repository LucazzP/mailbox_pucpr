<?php
   $json = $_POST;

   if (!isset($_SESSION['email'])) {		
      session_destroy();						
      // header("Location: /index.html");
      echo TRUE; 
      // exit;
   }
   if($json['sair']){
      session_destroy();						
      // header("Location: /index.html");
      echo TRUE; 
      // exit;
   }
   

?>
