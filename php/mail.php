<?php

   session_start(); 	//A seção deve ser iniciada em todas as páginas
   if (!isset($_SESSION['email'])) {		//Verifica se há seções
         session_destroy();						//Destroi a seção por segurança
         header("Location: /index.html"); 
         exit;	//Redireciona o visitante para login
   }
   $json = $_POST;

   $dom = new DOMDocument("1.0", "ISO-8859-1");
   $dom->load("../xml/emails.xml");
   #retirar os espacos em branco
   $dom->preserveWhiteSpace = false;

   $root = $dom->getElementsByTagName("tabelaEmails")-> item(0);

   $email = $dom->createElement("email");

   $email->setAttribute("id", 0);
   $email->setAttribute("de", $_SESSION['email']); //NAO SEI SE TA CERTO, MAS ACHO QUE TO PEGANDO O EMAIL DA SESSION
   $email->setAttribute("para", $json['para']);
   
   $root = $dom->createElement("cc", $json['cc']);
   $email->appendChild($root);

   $root = $dom->createElement("assunto", $json['assunto']);
   $email->appendChild($root);

   $root = $dom->createElement("texto", $json['texto']);
   $email->appendChild($root);

   $dom->appendChild($root);

   $dom->save("../xml/emails.xml");
?>
