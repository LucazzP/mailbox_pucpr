<?php

   $json = $_POST;
   // $email = $_POST['email'];
   
   $dom = new DOMDocument("1.0", "ISO-8859-1");
   $dom = simplexml_load_file("../xml/usuarios.xml") or die("Error: Objeto inexistente!");
   #retirar os espacos em branco
   $dom->preserveWhiteSpace = false;

   foreach($dom->children() as $usuario){
      if($usuario->email == $json['email'] && $usuario->senha == $json['senha']){
         echo true;
         if(!isset($_SESSION)) 	//verifica se há sessão aberta
         session_start();		//Inicia seção
         //Abrindo seções
         $_SESSION['email']=$json['email'];	
         exit;
      }else{
         echo false;
      }
   }
?>
