<?php

   session_start(); 	//A seção deve ser iniciada em todas as páginas
   if (!isset($_SESSION['email'])) {		//Verifica se há seções
         session_destroy();						//Destroi a seção por segurança
         header("Location: /index.html"); 
         exit;	//Redireciona o visitante para login
   }
   $json = $_POST;

   $dom = new DOMDocument("1.0", "ISO-8859-1");
   $dom = simplexml_load_file("../xml/emails.xml") or die("Error: Objeto inexistente!");
   #retirar os espacos em branco
   $dom->preserveWhiteSpace = false;

   foreach($dom->children() as $email){
      if($email->para == $_SESSION['email']){
            $dados = $email;
      }
      echo json_encode($dados);
      
   }
?>
