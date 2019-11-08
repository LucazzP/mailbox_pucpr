<?php

    session_start(); 	//A seção deve ser iniciada em todas as páginas
    if (!isset($_SESSION['email'])) {		//Verifica se há seções
        session_destroy();						//Destroi a seção por segurança
        header("Location: /index.html"); 
        exit;	//Redireciona o visitante para login
    }

   $json = $_POST;

   $emailToExclude = $json['emailToExclude'];
   $email = $_SESSION['email'];

   $xml = simplexml_load_file('../xml/usuarios.xml');

   $dom = new DOMDocument("1.0", "ISO-8859-1");

   $userXml = $xml->xpath('/tabelaUsuarios/usuario[email="' . $email . '"][1]');

   if(isset($userXml[0]->excluidos)){
      $userXml[0]->excluidos = $userXml[0]->excluidos . ',' . $emailToExclude;
   } else {
      $userXml[0]->addChild('excluidos', $emailToExclude);
   }

   $xml->asXML("../xml/usuarios.xml");

   echo true;
?>
