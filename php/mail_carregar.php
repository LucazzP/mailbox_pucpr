<?php

   session_start(); 	//A seção deve ser iniciada em todas as páginas
   if (!isset($_SESSION['email'])) {		//Verifica se há seções
         session_destroy();						//Destroi a seção por segurança
         header("Location: /index.html"); 
         exit;	//Redireciona o visitante para login
   }
   $json = $_POST;
?>
