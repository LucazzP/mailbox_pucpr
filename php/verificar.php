<?php
   if (!isset($_SESSION['email'])) {		//Verifica se há seções
   session_destroy();						//Destroi a seção por segurança
   return 
   exit;	//Redireciona o visitante para login
   }
?>
