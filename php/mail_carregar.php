<?php

   session_start(); 	//A seção deve ser iniciada em todas as páginas
   if (!isset($_SESSION['email'])) {		//Verifica se há seções
         session_destroy();						//Destroi a seção por segurança
         header("Location: /index.html"); 
         exit;	//Redireciona o visitante para login
   }
   $json = $_POST;

   $dom = new DOMDocument("1.0", "ISO-8859-1");
//    $dom = simplexml_load_file("../xml/emails.xml") or die("Error: Objeto inexistente!");
   #retirar os espacos em branco
   $dom->preserveWhiteSpace = false;
   $dados = array();
   $dom = simplexml_load_file("../xml/emails.xml");
   $xmlUsers = simplexml_load_file("../xml/usuarios.xml");
   $email = $_SESSION['email'];
   $request = $_json['request'];

   $userXml = $xmlUsers->xpath('/tabelaUsuarios/usuario[email="' . $email . '"][1]');
   $excluidos = (string) $userXml[0]->excluidos;
   $excluidos = explode(',', $excluidos);

   switch ($request) {
      case 'excluidos':
         # code...
         break;
      
      default:
         # code...
         break;
   }

   foreach($dom->children() as $email){
      if($email->para == $_SESSION['email'] || $email->cc == $_SESSION['email']){
         $isExcluded = false;
         foreach($excluidos as $idExcluido){
            if($idExcluido == $email->attributes()->{'id'}){
               $isExcluded = true;
            }
         }
         if(!$isExcluded) array_push($dados, json_encode($email));
      }
   }
   echo json_encode($dados);
?>
