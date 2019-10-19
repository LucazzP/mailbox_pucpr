<?php

   $json = $_POST;
   
   $dom = new DOMDocument("1.0", "ISO-8859-1");
   $dom = simplexml_load_file("../xml/usuarios.xml") or die("Error: Objeto inexistente!");
   #retirar os espacos em branco
   $dom->preserveWhiteSpace = false;

   foreach($dom->children() as $usuario){
      if($usuario->email == $json['email'] && $usuario->senha == $json['senha']){
         echo true;
      }else{
         echo false;
      }
   }
?>
