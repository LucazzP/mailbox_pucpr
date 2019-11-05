<?php

    session_start(); 	//A seção deve ser iniciada em todas as páginas
    if (!isset($_SESSION['email'])) {		//Verifica se há seções
        session_destroy();						//Destroi a seção por segurança
        header("Location: /index.html"); 
        exit;	//Redireciona o visitante para login
    }

   $json = $_POST;

   // $emailToExclude = $json['emailToExclude'];
//    $email = $_SESSION['email'];
   $email = 'renanteste@gmail.com.br';

   $xml = simplexml_load_file('../xml/usuarios.xml');

   $dom = new DOMDocument("1.0", "ISO-8859-1");

   $userXml = $xml->xpath('/tabelaUsuarios/usuario[email="' . $email . '"][1]');

   if(isset($userXml[0]->excluidos)){
      echo 'ata';
   } else {
      // $exclude = $dom->createElement('excluidos', $emailToExclude);
      // $userXml = 
      echo print_r($userXml);
   }

   // $xml->asXML("../xml/usuarios.xml");

//    $usuario = $dom->createElement("usuario");
   
//    #criando novo user
//    $email = $dom->createElement("email", $json['email']);
//    $senha = $dom->createElement("senha", $json['senha']);

//    #adicionando no root
//    $usuario->appendChild($email);
//    $usuario->appendChild($senha);
//    $root->appendChild($usuario);
//    $dom->appendChild($root);

//    #salvando o arquivo
//    $dom->save("../xml/usuarios.xml");
   
//    #mostrar dados na tela
//    header("Content-Type: text/xml");
//    $dom->saveXML();
?>
