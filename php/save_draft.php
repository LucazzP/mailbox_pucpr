<?php

   session_start(); 	//A seção deve ser iniciada em todas as páginas
   if (!isset($_SESSION['email'])) {		//Verifica se há seções
         session_destroy();						//Destroi a seção por segurança
         header("Location: /index.html"); 
         exit;	//Redireciona o visitante para login
   }
   $json = $_POST;
   
   $dom = new DOMDocument("1.0", "ISO-8859-1");
   $dom->load("../xml/rascunhos.xml");
   #retirar os espacos em branco
   $dom->preserveWhiteSpace = false;

   $root = $dom->getElementsByTagName("tabelaEmails")-> item(0);

   $id = $root->lastChild->getAttribute('id') + 1;

   $usuario = $dom->createElement("email");
   $usuario->setAttribute("id", $id);
   
   #criando novo email
   $de = $dom->createElement("de", $_SESSION['email']);
   $para = $dom->createElement("para", $json['para']);
   $cc = $dom->createElement("cc", $json['cc']);
   $assunto = $dom->createElement("assunto", $json['assunto']);
   $texto = $dom->createElement("texto", $json['texto']);

   #adicionando no root
   $usuario->appendChild($de);
   $usuario->appendChild($para);
   $usuario->appendChild($cc);
   $usuario->appendChild($assunto);
   $usuario->appendChild($texto);
   $root->appendChild($usuario);
   $dom->appendChild($root);

   #salvando o arquivo
   $dom->save("../xml/emails.xml");
   
   #mostrar dados na tela
   header("Content-Type: text/xml");
   print $dom->saveXML();

?>
