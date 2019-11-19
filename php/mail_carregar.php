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
   $dadosFiltrados = array();
   $dom = simplexml_load_file("../xml/emails.xml");
   $xmlUsers = simplexml_load_file("../xml/usuarios.xml");
   $email = $_SESSION['email'];
   $request = $_POST['request'];

   $userXml = $xmlUsers->xpath('/tabelaUsuarios/usuario[email="' . $email . '"][1]');
   

   foreach($dom->children() as $email){
      if($email->para == $_SESSION['email'] || $email->cc == $_SESSION['email']){
         array_push($dados, $email);
      }
   }

   switch ($request) {
      case 'favoritos':
         $favoritos = (string) $userXml[0]->favorites;
         $favoritos = explode(',', $favoritos);

         foreach($dados as $email){
            $isFavorite = false;
            foreach($favoritos as $idFavorito){
               if($idFavorito == $email->attributes()->{'id'}){
                  $isFavorite = true;
               }
            }
            if($isFavorite) array_push($dadosFiltrados, json_encode($email));
         }

         break;
      case 'rascunho':


         break;
      case 'enviados':
         $enviados = (string) $userXml[0]->enviados;
         $enviados = explode(',', $enviados);

         foreach($dom->children() as $email){
            if($email->de == $_SESSION['email']){
               array_push($dadosFiltrados, json_encode($email));
            }
         }    
         
         break;
      case 'excluidos':
         $excluidos = (string) $userXml[0]->excluidos;
         $excluidos = explode(',', $excluidos);

         foreach($dados as $email){
            $isExcluded = false;
            foreach($excluidos as $idExcluido){
               if($idExcluido == $email->attributes()->{'id'}){
                  $isExcluded = true;
               }
            }
            if($isExcluded) array_push($dadosFiltrados, json_encode($email));
         }

         break;
      default:
         $excluidos = (string) $userXml[0]->excluidos;
         $excluidos = explode(',', $excluidos);

         foreach($dados as $email){
            $isExcluded = false;
            foreach($excluidos as $idExcluido){
               if($idExcluido == $email->attributes()->{'id'}){
                  $isExcluded = true;
               }
            }
            if(!$isExcluded) array_push($dadosFiltrados, json_encode($email));
         }

         break;
   }

   echo json_encode($dadosFiltrados);
?>
